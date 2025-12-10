<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BusRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Hold a seat for 10 minutes
     */
    public function holdSeat(Request $request)
    {
        $request->validate([
            'bus_route_id' => 'required|exists:bus_routes,id',
            'seat_number' => 'required|integer|min:1',
            'booking_date' => 'required|date|after_or_equal:today',
        ]);

        try {
            DB::beginTransaction();

            // Check if seat is already booked or on hold
            $existingBooking = Booking::where('bus_route_id', $request->bus_route_id)
                ->where('seat_number', $request->seat_number)
                ->where('booking_date', $request->booking_date)
                ->where(function($query) {
                    $query->where('status', 'confirmed')
                          ->orWhere(function($q) {
                              $q->where('status', 'on_hold')
                                ->where('hold_expires_at', '>', Carbon::now());
                          });
                })
                ->first();

            if ($existingBooking) {
                return response()->json([
                    'success' => false,
                    'message' => 'This seat is already booked or being held by another user.'
                ], 422);
            }

            // Create a temporary hold booking
            $holdExpiresAt = Carbon::now()->addMinutes(10);
            
            $booking = Booking::create([
                'bus_route_id' => $request->bus_route_id,
                'seat_number' => $request->seat_number,
                'booking_date' => $request->booking_date,
                'status' => 'on_hold',
                'hold_expires_at' => $holdExpiresAt,
                'student_name' => 'Pending',
                'student_id' => 'Pending',
                'student_email' => 'pending@temp.com',
                'student_phone' => '00000000000',
                'amount_paid' => 0,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Seat held successfully for 10 minutes',
                'booking_id' => $booking->id,
                'expires_at' => $holdExpiresAt->toIso8601String(),
                'expires_in_seconds' => 600
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to hold seat: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Release expired holds (called automatically)
     */
    public function releaseExpiredHolds()
    {
        $releasedCount = Booking::where('status', 'on_hold')
            ->where('hold_expires_at', '<=', Carbon::now())
            ->delete();

        return response()->json([
            'success' => true,
            'released_count' => $releasedCount
        ]);
    }

    /**
     * Cancel a hold (when user closes payment page)
     */
    public function cancelHold($bookingId)
    {
        $booking = Booking::where('id', $bookingId)
            ->where('status', 'on_hold')
            ->first();

        if ($booking) {
            $booking->delete();
            return response()->json([
                'success' => true,
                'message' => 'Hold released successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Hold not found or already expired'
        ], 404);
    }
}
