<?php

namespace App\Http\Controllers;

use App\Models\BusRoute;
use Illuminate\Http\Request;

class BusRouteController extends Controller
{
    /**
     * Display the homepage with search form
     */
    public function index()
    {
        $pickupLocations = BusRoute::getPickupLocations();
        $dropoffLocations = BusRoute::getDropoffLocations();
        
        return view('bus-routes.index', compact('pickupLocations', 'dropoffLocations'));
    }

    /**
     * Search for bus routes based on pickup and dropoff locations
     */
    public function search(Request $request)
    {
        $request->validate([
            'pickup_location' => 'nullable|string|max:255',
            'dropoff_location' => 'nullable|string|max:255',
        ]);

        $pickup = $request->input('pickup_location');
        $dropoff = $request->input('dropoff_location');

        // Get search results
        $routes = BusRoute::searchRoutes($pickup, $dropoff);

        // Get location lists for the form
        $pickupLocations = BusRoute::getPickupLocations();
        $dropoffLocations = BusRoute::getDropoffLocations();

        return view('bus-routes.index', compact('routes', 'pickup', 'dropoff', 'pickupLocations', 'dropoffLocations'));
    }

    /**
     * Display all active routes
     */
    public function allRoutes()
    {
        $routes = BusRoute::where('status', 'active')
            ->orderBy('pickup_location')
            ->orderBy('departure_time')
            ->get();

        return view('bus-routes.all', compact('routes'));
    }

    /**
     * Display seat layout for a specific route
     */
    public function seatLayout($id, Request $request)
    {
        $route = BusRoute::findOrFail($id);
        
        // Get date from query parameter or use today
        $date = $request->input('date', date('Y-m-d'));
        
        // Get seat layout
        $seats = $route->getSeatLayout($date);
        
        // Get booking statistics
        $bookedSeats = $route->getBookedSeatsForDate($date);
        $availableSeats = $route->getAvailableSeatsForDate($date);
        $totalSeats = $route->available_seats;
        $bookedCount = count($bookedSeats);
        
        return view('bus-routes.seat-layout', compact(
            'route', 
            'seats', 
            'date', 
            'bookedCount', 
            'availableSeats',
            'totalSeats'
        ));
    }
}
