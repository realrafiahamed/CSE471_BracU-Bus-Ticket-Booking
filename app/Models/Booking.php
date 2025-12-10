<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_route_id',
        'student_name',
        'student_id',
        'student_email',
        'student_phone',
        'seat_number',
        'booking_date',
        'status',
        'hold_expires_at',
        'amount_paid'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'hold_expires_at' => 'datetime',
        'amount_paid' => 'decimal:2'
    ];

    /**
     * Get the bus route for this booking
     */
    public function busRoute()
    {
        return $this->belongsTo(BusRoute::class);
    }

    /**
     * Get all booked seat numbers for a specific route and date
     */
    public static function getBookedSeats($busRouteId, $date)
    {
        return self::where('bus_route_id', $busRouteId)
            ->where('booking_date', $date)
            ->where('status', 'confirmed')
            ->pluck('seat_number')
            ->toArray();
    }

    /**
     * Check if a specific seat is available
     */
    public static function isSeatAvailable($busRouteId, $seatNumber, $date)
    {
        return !self::where('bus_route_id', $busRouteId)
            ->where('seat_number', $seatNumber)
            ->where('booking_date', $date)
            ->where('status', 'confirmed')
            ->exists();
    }

    /**
     * Get booking count for a route on a specific date
     */
    public static function getBookingCount($busRouteId, $date)
    {
        return self::where('bus_route_id', $busRouteId)
            ->where('booking_date', $date)
            ->where('status', 'confirmed')
            ->count();
    }
}
