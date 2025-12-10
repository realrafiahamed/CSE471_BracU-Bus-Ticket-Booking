@extends('layouts.app')

@section('title', 'Search Bus Routes - BRACU Transport')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-lg shadow-xl p-8 mb-8 text-white">
        <div class="text-center">
            <h2 class="text-4xl font-bold mb-3">
                <i class="fas fa-map-marked-alt mr-3"></i>Find Your Bus Route
            </h2>
            <p class="text-blue-100 text-lg">Search for available bus routes to BRAC University, Merul Badda</p>
        </div>
    </div>

    <!-- Search Form -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <form action="{{ route('bus-routes.search') }}" method="GET" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pickup Location -->
                <div>
                    <label for="pickup_location" class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-map-marker-alt text-green-600 mr-2"></i>Pickup Location
                    </label>
                    <input 
                        type="text" 
                        name="pickup_location" 
                        id="pickup_location" 
                        value="{{ old('pickup_location', $pickup ?? '') }}"
                        list="pickup-suggestions"
                        placeholder="e.g., Mirpur 10, Uttara, Gulshan"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    >
                    <datalist id="pickup-suggestions">
                        @foreach($pickupLocations as $location)
                            <option value="{{ $location }}">
                        @endforeach
                    </datalist>
                </div>

                <!-- Dropoff Location -->
                <div>
                    <label for="dropoff_location" class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-map-marker-alt text-red-600 mr-2"></i>Dropoff Location
                    </label>
                    <input 
                        type="text" 
                        name="dropoff_location" 
                        id="dropoff_location" 
                        value="{{ old('dropoff_location', $dropoff ?? '') }}"
                        list="dropoff-suggestions"
                        placeholder="e.g., BRACU Campus, Merul Badda"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    >
                    <datalist id="dropoff-suggestions">
                        @foreach($dropoffLocations as $location)
                            <option value="{{ $location }}">
                        @endforeach
                    </datalist>
                </div>
            </div>

            <!-- Search Button -->
            <div class="flex justify-center">
                <button 
                    type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform hover:scale-105 transition duration-200 flex items-center space-x-2"
                >
                    <i class="fas fa-search"></i>
                    <span>Search Routes</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Search Results -->
    @if(isset($routes))
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-list-ul text-blue-600 mr-3"></i>
                Available Routes
                <span class="ml-3 text-sm bg-blue-100 text-blue-800 px-3 py-1 rounded-full">
                    {{ $routes->count() }} {{ $routes->count() == 1 ? 'route' : 'routes' }} found
                </span>
            </h3>

            @if($routes->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-exclamation-circle text-gray-400 text-6xl mb-4"></i>
                    <p class="text-gray-600 text-lg">No routes found matching your search criteria.</p>
                    <p class="text-gray-500 mt-2">Try adjusting your pickup or dropoff locations.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($routes as $route)
                        <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition duration-200 bg-gradient-to-r from-white to-blue-50">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <!-- Route Info -->
                                <div class="flex-1">
                                    <div class="flex items-center mb-3">
                                        <span class="bg-blue-600 text-white px-3 py-1 rounded-lg font-bold text-sm mr-3">
                                            {{ $route->bus_number }}
                                        </span>
                                        <h4 class="text-lg font-semibold text-gray-800">{{ $route->route_name }}</h4>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                        <!-- Locations -->
                                        <div class="flex items-start space-x-2">
                                            <i class="fas fa-route text-blue-600 mt-1"></i>
                                            <div>
                                                <p class="text-gray-700">
                                                    <span class="font-semibold text-green-600">From:</span> 
                                                    {{ $route->pickup_location }}
                                                </p>
                                                <p class="text-gray-700">
                                                    <span class="font-semibold text-red-600">To:</span> 
                                                    {{ $route->dropoff_location }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Time & Duration -->
                                        <div class="flex items-start space-x-2">
                                            <i class="fas fa-clock text-blue-600 mt-1"></i>
                                            <div>
                                                <p class="text-gray-700">
                                                    <span class="font-semibold">Departs:</span> 
                                                    {{ date('g:i A', strtotime($route->departure_time)) }}
                                                </p>
                                                <p class="text-gray-700">
                                                    <span class="font-semibold">Arrives:</span> 
                                                    {{ date('g:i A', strtotime($route->arrival_time)) }}
                                                </p>
                                                <p class="text-gray-600 text-xs">
                                                    Duration: {{ $route->formatted_duration }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Operating Days -->
                                    <div class="mt-2 flex items-center text-xs text-gray-600">
                                        <i class="fas fa-calendar text-blue-600 mr-2"></i>
                                        <span>{{ $route->days_operating }}</span>
                                    </div>
                                </div>

                                <!-- Fare & Seats -->
                                <div class="mt-4 md:mt-0 md:ml-6 flex md:flex-col items-center md:items-end space-x-4 md:space-x-0 md:space-y-2">
                                    <div class="text-center">
                                        <p class="text-3xl font-bold text-blue-600">৳{{ number_format($route->fare, 0) }}</p>
                                        <p class="text-xs text-gray-600">Fare</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-lg font-semibold text-green-600">
                                            <i class="fas fa-chair mr-1"></i>{{ $route->available_seats }}
                                        </p>
                                        <p class="text-xs text-gray-600">Total Seats</p>
                                    </div>
                                    <!-- View Seats Button -->
                                    <div class="text-center mt-2">
                                        <a href="{{ route('bus-routes.seats', $route->id) }}" 
                                           class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-200 text-sm">
                                            <i class="fas fa-eye mr-2"></i>
                                            View Seats
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    <!-- Quick Info Section -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <div class="text-blue-600 text-4xl mb-3">
                <i class="fas fa-route"></i>
            </div>
            <h4 class="text-lg font-bold text-gray-800 mb-2">Multiple Routes</h4>
            <p class="text-gray-600 text-sm">Choose from various pickup points across Dhaka</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <div class="text-green-600 text-4xl mb-3">
                <i class="fas fa-clock"></i>
            </div>
            <h4 class="text-lg font-bold text-gray-800 mb-2">Timely Service</h4>
            <p class="text-gray-600 text-sm">Punctual buses running Monday to Saturday</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <div class="text-purple-600 text-4xl mb-3">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <h4 class="text-lg font-bold text-gray-800 mb-2">Affordable Fares</h4>
            <p class="text-gray-600 text-sm">Budget-friendly pricing for students</p>
        </div>
    </div>
</div>
@endsection
