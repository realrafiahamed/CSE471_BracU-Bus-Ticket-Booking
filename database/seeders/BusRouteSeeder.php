<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BusRoute;
use Carbon\Carbon;

class BusRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = [
            // Routes from Mirpur to BRACU
            [
                'route_name' => 'Mirpur-BRACU Direct',
                'bus_number' => 'BRACU-101',
                'pickup_location' => 'Mirpur 10',
                'dropoff_location' => 'BRACU Campus, Merul Badda',
                'departure_time' => '07:00:00',
                'arrival_time' => '08:15:00',
                'duration_minutes' => 75,
                'fare' => 50.00,
                'available_seats' => 40,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ],
            [
                'route_name' => 'Mirpur-BRACU Morning',
                'bus_number' => 'BRACU-102',
                'pickup_location' => 'Mirpur 1',
                'dropoff_location' => 'BRACU Campus, Merul Badda',
                'departure_time' => '07:30:00',
                'arrival_time' => '08:30:00',
                'duration_minutes' => 60,
                'fare' => 45.00,
                'available_seats' => 35,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ],
            
            // Routes from Uttara to BRACU
            [
                'route_name' => 'Uttara-BRACU Express',
                'bus_number' => 'BRACU-201',
                'pickup_location' => 'Uttara Sector 7',
                'dropoff_location' => 'BRACU Campus, Merul Badda',
                'departure_time' => '07:15:00',
                'arrival_time' => '08:00:00',
                'duration_minutes' => 45,
                'fare' => 40.00,
                'available_seats' => 45,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ],
            [
                'route_name' => 'Uttara-BRACU Late Morning',
                'bus_number' => 'BRACU-202',
                'pickup_location' => 'Uttara Sector 3',
                'dropoff_location' => 'BRACU Campus, Merul Badda',
                'departure_time' => '08:00:00',
                'arrival_time' => '08:45:00',
                'duration_minutes' => 45,
                'fare' => 40.00,
                'available_seats' => 40,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ],
            
            // Routes from Mohakhali to BRACU
            [
                'route_name' => 'Mohakhali-BRACU Direct',
                'bus_number' => 'BRACU-301',
                'pickup_location' => 'Mohakhali Bus Stand',
                'dropoff_location' => 'BRACU Campus, Merul Badda',
                'departure_time' => '07:45:00',
                'arrival_time' => '08:15:00',
                'duration_minutes' => 30,
                'fare' => 30.00,
                'available_seats' => 35,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ],
            [
                'route_name' => 'Mohakhali-BRACU Morning',
                'bus_number' => 'BRACU-302',
                'pickup_location' => 'Mohakhali DOHS',
                'dropoff_location' => 'BRACU Campus, Merul Badda',
                'departure_time' => '08:15:00',
                'arrival_time' => '08:40:00',
                'duration_minutes' => 25,
                'fare' => 25.00,
                'available_seats' => 30,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ],
            
            // Routes from Dhanmondi to BRACU
            [
                'route_name' => 'Dhanmondi-BRACU Express',
                'bus_number' => 'BRACU-401',
                'pickup_location' => 'Dhanmondi 27',
                'dropoff_location' => 'BRACU Campus, Merul Badda',
                'departure_time' => '07:00:00',
                'arrival_time' => '08:00:00',
                'duration_minutes' => 60,
                'fare' => 50.00,
                'available_seats' => 40,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ],
            [
                'route_name' => 'Dhanmondi-BRACU Morning',
                'bus_number' => 'BRACU-402',
                'pickup_location' => 'Dhanmondi 32',
                'dropoff_location' => 'BRACU Campus, Merul Badda',
                'departure_time' => '07:30:00',
                'arrival_time' => '08:30:00',
                'duration_minutes' => 60,
                'fare' => 50.00,
                'available_seats' => 35,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ],
            
            // Routes from Gulshan to BRACU
            [
                'route_name' => 'Gulshan-BRACU Direct',
                'bus_number' => 'BRACU-501',
                'pickup_location' => 'Gulshan 1',
                'dropoff_location' => 'BRACU Campus, Merul Badda',
                'departure_time' => '07:30:00',
                'arrival_time' => '08:00:00',
                'duration_minutes' => 30,
                'fare' => 35.00,
                'available_seats' => 40,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ],
            [
                'route_name' => 'Gulshan-BRACU Express',
                'bus_number' => 'BRACU-502',
                'pickup_location' => 'Gulshan 2',
                'dropoff_location' => 'BRACU Campus, Merul Badda',
                'departure_time' => '08:00:00',
                'arrival_time' => '08:25:00',
                'duration_minutes' => 25,
                'fare' => 30.00,
                'available_seats' => 35,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ],
            
            // Routes from Banani to BRACU
            [
                'route_name' => 'Banani-BRACU Direct',
                'bus_number' => 'BRACU-601',
                'pickup_location' => 'Banani',
                'dropoff_location' => 'BRACU Campus, Merul Badda',
                'departure_time' => '07:45:00',
                'arrival_time' => '08:10:00',
                'duration_minutes' => 25,
                'fare' => 30.00,
                'available_seats' => 30,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ],
            
            // Routes from Khilkhet to BRACU
            [
                'route_name' => 'Khilkhet-BRACU Direct',
                'bus_number' => 'BRACU-701',
                'pickup_location' => 'Khilkhet',
                'dropoff_location' => 'BRACU Campus, Merul Badda',
                'departure_time' => '07:30:00',
                'arrival_time' => '07:50:00',
                'duration_minutes' => 20,
                'fare' => 25.00,
                'available_seats' => 30,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ],
            
            // Routes from Bashundhara to BRACU
            [
                'route_name' => 'Bashundhara-BRACU Direct',
                'bus_number' => 'BRACU-801',
                'pickup_location' => 'Bashundhara R/A',
                'dropoff_location' => 'BRACU Campus, Merul Badda',
                'departure_time' => '07:30:00',
                'arrival_time' => '08:00:00',
                'duration_minutes' => 30,
                'fare' => 35.00,
                'available_seats' => 35,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ],
            
            // Return routes (BRACU to different locations)
            [
                'route_name' => 'BRACU-Mirpur Return',
                'bus_number' => 'BRACU-103',
                'pickup_location' => 'BRACU Campus, Merul Badda',
                'dropoff_location' => 'Mirpur 10',
                'departure_time' => '17:00:00',
                'arrival_time' => '18:15:00',
                'duration_minutes' => 75,
                'fare' => 50.00,
                'available_seats' => 40,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ],
            [
                'route_name' => 'BRACU-Uttara Return',
                'bus_number' => 'BRACU-203',
                'pickup_location' => 'BRACU Campus, Merul Badda',
                'dropoff_location' => 'Uttara Sector 7',
                'departure_time' => '17:00:00',
                'arrival_time' => '17:45:00',
                'duration_minutes' => 45,
                'fare' => 40.00,
                'available_seats' => 45,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ],
            [
                'route_name' => 'BRACU-Dhanmondi Return',
                'bus_number' => 'BRACU-403',
                'pickup_location' => 'BRACU Campus, Merul Badda',
                'dropoff_location' => 'Dhanmondi 27',
                'departure_time' => '17:30:00',
                'arrival_time' => '18:30:00',
                'duration_minutes' => 60,
                'fare' => 50.00,
                'available_seats' => 40,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ],
            [
                'route_name' => 'BRACU-Gulshan Return',
                'bus_number' => 'BRACU-503',
                'pickup_location' => 'BRACU Campus, Merul Badda',
                'dropoff_location' => 'Gulshan 1',
                'departure_time' => '17:00:00',
                'arrival_time' => '17:30:00',
                'duration_minutes' => 30,
                'fare' => 35.00,
                'available_seats' => 40,
                'status' => 'active',
                'days_operating' => 'Monday-Saturday'
            ]
        ];

        foreach ($routes as $route) {
            BusRoute::create($route);
        }
    }
}
