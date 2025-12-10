<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\BusRoute;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some bus routes
        $route1 = BusRoute::where('bus_number', 'BRACU-101')->first();
        $route2 = BusRoute::where('bus_number', 'BRACU-201')->first();
        $route3 = BusRoute::where('bus_number', 'BRACU-301')->first();

        if (!$route1 || !$route2 || !$route3) {
            $this->command->error('Please run BusRouteSeeder first!');
            return;
        }

        // Today's date
        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime('+1 day'));

        $bookings = [
            // BRACU-101 (Mirpur-BRACU Direct) - Today
            [
                'bus_route_id' => $route1->id,
                'student_name' => 'Ahmed Hassan',
                'student_id' => '20101001',
                'student_email' => 'ahmed.hassan@bracu.ac.bd',
                'student_phone' => '01711111111',
                'seat_number' => 1,
                'booking_date' => $today,
                'status' => 'confirmed',
                'amount_paid' => $route1->fare
            ],
            [
                'bus_route_id' => $route1->id,
                'student_name' => 'Fatima Rahman',
                'student_id' => '20101002',
                'student_email' => 'fatima.rahman@bracu.ac.bd',
                'student_phone' => '01722222222',
                'seat_number' => 2,
                'booking_date' => $today,
                'status' => 'confirmed',
                'amount_paid' => $route1->fare
            ],
            [
                'bus_route_id' => $route1->id,
                'student_name' => 'Rifat Hossain',
                'student_id' => '20101003',
                'student_email' => 'rifat.hossain@bracu.ac.bd',
                'student_phone' => '01733333333',
                'seat_number' => 5,
                'booking_date' => $today,
                'status' => 'confirmed',
                'amount_paid' => $route1->fare
            ],
            [
                'bus_route_id' => $route1->id,
                'student_name' => 'Nusrat Jahan',
                'student_id' => '20101004',
                'student_email' => 'nusrat.jahan@bracu.ac.bd',
                'student_phone' => '01744444444',
                'seat_number' => 6,
                'booking_date' => $today,
                'status' => 'confirmed',
                'amount_paid' => $route1->fare
            ],
            [
                'bus_route_id' => $route1->id,
                'student_name' => 'Tanvir Ahmed',
                'student_id' => '20101005',
                'student_email' => 'tanvir.ahmed@bracu.ac.bd',
                'student_phone' => '01755555555',
                'seat_number' => 10,
                'booking_date' => $today,
                'status' => 'confirmed',
                'amount_paid' => $route1->fare
            ],
            [
                'bus_route_id' => $route1->id,
                'student_name' => 'Sadia Islam',
                'student_id' => '20101006',
                'student_email' => 'sadia.islam@bracu.ac.bd',
                'student_phone' => '01766666666',
                'seat_number' => 11,
                'booking_date' => $today,
                'status' => 'confirmed',
                'amount_paid' => $route1->fare
            ],
            [
                'bus_route_id' => $route1->id,
                'student_name' => 'Karim Uddin',
                'student_id' => '20101007',
                'student_email' => 'karim.uddin@bracu.ac.bd',
                'student_phone' => '01777777777',
                'seat_number' => 15,
                'booking_date' => $today,
                'status' => 'confirmed',
                'amount_paid' => $route1->fare
            ],
            [
                'bus_route_id' => $route1->id,
                'student_name' => 'Maliha Khan',
                'student_id' => '20101008',
                'student_email' => 'maliha.khan@bracu.ac.bd',
                'student_phone' => '01788888888',
                'seat_number' => 20,
                'booking_date' => $today,
                'status' => 'confirmed',
                'amount_paid' => $route1->fare
            ],

            // BRACU-201 (Uttara-BRACU Express) - Today
            [
                'bus_route_id' => $route2->id,
                'student_name' => 'Rafi Islam',
                'student_id' => '20102001',
                'student_email' => 'rafi.islam@bracu.ac.bd',
                'student_phone' => '01811111111',
                'seat_number' => 1,
                'booking_date' => $today,
                'status' => 'confirmed',
                'amount_paid' => $route2->fare
            ],
            [
                'bus_route_id' => $route2->id,
                'student_name' => 'Shabnam Sultana',
                'student_id' => '20102002',
                'student_email' => 'shabnam.sultana@bracu.ac.bd',
                'student_phone' => '01822222222',
                'seat_number' => 3,
                'booking_date' => $today,
                'status' => 'confirmed',
                'amount_paid' => $route2->fare
            ],
            [
                'bus_route_id' => $route2->id,
                'student_name' => 'Imran Chowdhury',
                'student_id' => '20102003',
                'student_email' => 'imran.chow@bracu.ac.bd',
                'student_phone' => '01833333333',
                'seat_number' => 4,
                'booking_date' => $today,
                'status' => 'confirmed',
                'amount_paid' => $route2->fare
            ],
            [
                'bus_route_id' => $route2->id,
                'student_name' => 'Tasnim Haque',
                'student_id' => '20102004',
                'student_email' => 'tasnim.haque@bracu.ac.bd',
                'student_phone' => '01844444444',
                'seat_number' => 12,
                'booking_date' => $today,
                'status' => 'confirmed',
                'amount_paid' => $route2->fare
            ],
            [
                'bus_route_id' => $route2->id,
                'student_name' => 'Fahim Rahman',
                'student_id' => '20102005',
                'student_email' => 'fahim.rahman@bracu.ac.bd',
                'student_phone' => '01855555555',
                'seat_number' => 18,
                'booking_date' => $today,
                'status' => 'confirmed',
                'amount_paid' => $route2->fare
            ],

            // BRACU-301 (Mohakhali-BRACU Direct) - Today
            [
                'bus_route_id' => $route3->id,
                'student_name' => 'Nawrin Tabassum',
                'student_id' => '20103001',
                'student_email' => 'nawrin.tab@bracu.ac.bd',
                'student_phone' => '01911111111',
                'seat_number' => 2,
                'booking_date' => $today,
                'status' => 'confirmed',
                'amount_paid' => $route3->fare
            ],
            [
                'bus_route_id' => $route3->id,
                'student_name' => 'Sakib Al Hasan',
                'student_id' => '20103002',
                'student_email' => 'sakib.hasan@bracu.ac.bd',
                'student_phone' => '01922222222',
                'seat_number' => 7,
                'booking_date' => $today,
                'status' => 'confirmed',
                'amount_paid' => $route3->fare
            ],
            [
                'bus_route_id' => $route3->id,
                'student_name' => 'Lamia Karim',
                'student_id' => '20103003',
                'student_email' => 'lamia.karim@bracu.ac.bd',
                'student_phone' => '01933333333',
                'seat_number' => 8,
                'booking_date' => $today,
                'status' => 'confirmed',
                'amount_paid' => $route3->fare
            ],

            // Tomorrow's bookings for BRACU-101
            [
                'bus_route_id' => $route1->id,
                'student_name' => 'Zubair Mahmud',
                'student_id' => '20101009',
                'student_email' => 'zubair.mahmud@bracu.ac.bd',
                'student_phone' => '01799999999',
                'seat_number' => 1,
                'booking_date' => $tomorrow,
                'status' => 'confirmed',
                'amount_paid' => $route1->fare
            ],
            [
                'bus_route_id' => $route1->id,
                'student_name' => 'Farah Naz',
                'student_id' => '20101010',
                'student_email' => 'farah.naz@bracu.ac.bd',
                'student_phone' => '01700000000',
                'seat_number' => 3,
                'booking_date' => $tomorrow,
                'status' => 'confirmed',
                'amount_paid' => $route1->fare
            ],
        ];

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }

        $this->command->info('Created ' . count($bookings) . ' sample bookings successfully!');
    }
}
