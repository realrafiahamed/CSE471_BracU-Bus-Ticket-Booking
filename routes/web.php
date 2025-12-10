<?php

use App\Http\Controllers\BusRouteController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Homepage with search form
Route::get('/', [BusRouteController::class, 'index'])->name('home');

// Search routes
Route::get('/search', [BusRouteController::class, 'search'])->name('bus-routes.search');

// View all routes
Route::get('/all-routes', [BusRouteController::class, 'allRoutes'])->name('bus-routes.all');

// View seat layout for a specific route
Route::get('/bus-routes/{id}/seats', [BusRouteController::class, 'seatLayout'])->name('bus-routes.seats');

// Booking routes
Route::post('/bookings/hold', [BookingController::class, 'holdSeat'])->name('bookings.hold');
Route::delete('/bookings/{id}/cancel-hold', [BookingController::class, 'cancelHold'])->name('bookings.cancel-hold');
Route::post('/bookings/release-expired', [BookingController::class, 'releaseExpiredHolds'])->name('bookings.release-expired');
