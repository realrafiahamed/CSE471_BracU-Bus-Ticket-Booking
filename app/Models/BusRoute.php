<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_name',
        'bus_number',
        'pickup_location',
        'dropoff_location',
        'departure_time',
        'arrival_time',
        'duration_minutes',
        'fare',
        'available_seats',
        'status',
        'days_operating'
    ];

    /**
     * Search for bus routes based on pickup and dropoff locations
     */
    public static function searchRoutes($pickup, $dropoff)
    {
        $query = self::where('status', 'active');

        if (!empty($pickup)) {
            $query->where('pickup_location', 'LIKE', '%' . $pickup . '%');
        }

        if (!empty($dropoff)) {
            $query->where('dropoff_location', 'LIKE', '%' . $dropoff . '%');
        }

        return $query->orderBy('departure_time')->get();
    }

    /**
     * Get all unique pickup locations
     */
    public static function getPickupLocations()
    {
        return self::where('status', 'active')
            ->distinct()
            ->pluck('pickup_location')
            ->sort()
            ->values();
    }

    /**
     * Get all unique dropoff locations
     */
    public static function getDropoffLocations()
    {
        return self::where('status', 'active')
            ->distinct()
            ->pluck('dropoff_location')
            ->sort()
            ->values();
    }

    /**
     * Format duration for display
     */
    public function getFormattedDurationAttribute()
    {
        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;
        
        if ($hours > 0) {
            return $hours . 'h ' . $minutes . 'm';
        }
        return $minutes . ' minutes';
    }

    /**
     * Get all bookings for this route
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get booked seats for a specific date
     */
    public function getBookedSeatsForDate($date)
    {
        return Booking::getBookedSeats($this->id, $date);
    }

    /**
     * Get available seats count for a specific date
     */
    public function getAvailableSeatsForDate($date)
    {
        $bookedCount = Booking::getBookingCount($this->id, $date);
        return $this->available_seats - $bookedCount;
    }

    /**
     * Generate seat layout array
     * Returns array of seats with their status (available, booked, on_hold)
     */
    public function getSeatLayout($date)
    {
        $seats = [];
        
        // Get all bookings for this route and date
        $bookings = Booking::where('bus_route_id', $this->id)
            ->where('booking_date', $date)
            ->where(function($query) {
                $query->where('status', 'confirmed')
                      ->orWhere(function($q) {
                          $q->where('status', 'on_hold')
                            ->where('hold_expires_at', '>', now());
                      });
            })
            ->get()
            ->keyBy('seat_number');
        
        for ($i = 1; $i <= $this->available_seats; $i++) {
            if (isset($bookings[$i])) {
                $status = $bookings[$i]->status === 'on_hold' ? 'on_hold' : 'booked';
                $seats[$i] = [
                    'number' => $i,
                    'status' => $status,
                    'expires_at' => $bookings[$i]->hold_expires_at
                ];
            } else {
                $seats[$i] = [
                    'number' => $i,
                    'status' => 'available',
                    'expires_at' => null
                ];
            }
        }
        
        return $seats;
    }
}
