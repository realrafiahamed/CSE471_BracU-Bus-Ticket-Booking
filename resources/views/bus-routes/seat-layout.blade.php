@extends('layouts.app')

@section('title', 'Seat Layout - ' . $route->route_name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-lg shadow-xl p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold mb-2">
                    <i class="fas fa-chair mr-3"></i>Seat Layout
                </h2>
                <p class="text-blue-100 text-lg">{{ $route->route_name }} - {{ $route->bus_number }}</p>
            </div>
            <div class="text-right">
                <div class="text-4xl font-bold">{{ $availableSeats }}/{{ $totalSeats }}</div>
                <div class="text-blue-100">Seats Available</div>
            </div>
        </div>
    </div>

    <!-- Route Information Card -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex items-center space-x-3">
                <i class="fas fa-route text-blue-600 text-2xl"></i>
                <div>
                    <p class="text-sm text-gray-600">Route</p>
                    <p class="font-semibold text-gray-800">{{ $route->pickup_location }} → {{ $route->dropoff_location }}</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <i class="fas fa-clock text-blue-600 text-2xl"></i>
                <div>
                    <p class="text-sm text-gray-600">Departure</p>
                    <p class="font-semibold text-gray-800">{{ date('g:i A', strtotime($route->departure_time)) }}</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <i class="fas fa-money-bill-wave text-blue-600 text-2xl"></i>
                <div>
                    <p class="text-sm text-gray-600">Fare</p>
                    <p class="font-semibold text-gray-800">৳{{ number_format($route->fare, 0) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Date Selector -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <form method="GET" action="{{ route('bus-routes.seats', $route->id) }}" class="flex items-center space-x-4">
            <label for="date" class="text-gray-700 font-semibold flex items-center">
                <i class="fas fa-calendar text-blue-600 mr-2"></i>
                Select Date:
            </label>
            <input 
                type="date" 
                name="date" 
                id="date" 
                value="{{ $date }}"
                min="{{ date('Y-m-d') }}"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
            <button 
                type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200"
            >
                Update
            </button>
        </form>
        <p class="text-sm text-gray-600 mt-2">
            <i class="fas fa-info-circle mr-1"></i>
            Showing seat availability for {{ date('F d, Y', strtotime($date)) }}
        </p>
    </div>

    <!-- Seat Legend -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Legend</h3>
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center text-white font-bold shadow cursor-pointer">
                    <i class="fas fa-chair"></i>
                </div>
                <span class="text-gray-700 font-medium">Available</span>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center text-white font-bold shadow">
                    <i class="fas fa-chair"></i>
                </div>
                <span class="text-gray-700 font-medium">On Hold</span>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center text-white font-bold shadow">
                    <i class="fas fa-chair"></i>
                </div>
                <span class="text-gray-700 font-medium">Booked</span>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold shadow">
                    <i class="fas fa-chair"></i>
                </div>
                <span class="text-gray-700 font-medium">Selected</span>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gray-400 rounded-lg flex items-center justify-center text-white font-bold">
                    <i class="fas fa-user-tie"></i>
                </div>
                <span class="text-gray-700 font-medium">Staff</span>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-white border-2 border-gray-400 rounded-lg flex items-center justify-center text-gray-600 font-bold">
                    <i class="fas fa-door-open"></i>
                </div>
                <span class="text-gray-700 font-medium">Entry/Exit</span>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
            <div class="text-4xl font-bold text-blue-600 mb-2">{{ $totalSeats }}</div>
            <div class="text-gray-600">Total Seats</div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
            <div class="text-4xl font-bold text-green-600 mb-2">{{ $availableSeats }}</div>
            <div class="text-gray-600">Available Seats</div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
            <div class="text-4xl font-bold text-red-600 mb-2">{{ $bookedCount }}</div>
            <div class="text-gray-600">Booked Seats</div>
        </div>
    </div>

    <!-- Seat Layout -->
    <div class="bg-white rounded-lg shadow-xl p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Bus Seat Layout</h3>
        
        <!-- Bus Front Section -->
        <div class="max-w-3xl mx-auto">
            <!-- Front Row: Door (Left), Empty, Driver, Contractor (Right) -->
            <div class="grid grid-cols-4 gap-3 mb-4 p-4 bg-gray-100 rounded-lg">
                <!-- Entry/Exit Door -->
                <div class="w-full h-20 bg-white border-2 border-gray-400 rounded-lg flex flex-col items-center justify-center text-gray-600 shadow-md">
                    <i class="fas fa-door-open text-2xl"></i>
                    <span class="text-xs font-semibold mt-1">Entry/Exit</span>
                </div>
                
                <!-- Empty Space -->
                <div class="w-full h-20"></div>
                
                <!-- Driver Seat -->
                <div class="w-full h-20 bg-gray-400 rounded-lg flex flex-col items-center justify-center text-white shadow-md">
                    <i class="fas fa-steering-wheel text-2xl"></i>
                    <span class="text-xs font-semibold mt-1">Driver</span>
                </div>
                
                <!-- Contractor Seat -->
                <div class="w-full h-20 bg-gray-400 rounded-lg flex flex-col items-center justify-center text-white shadow-md">
                    <i class="fas fa-user-tie text-2xl"></i>
                    <span class="text-xs font-semibold mt-1">Staff</span>
                </div>
            </div>

            <div class="text-center text-gray-500 text-sm mb-4">
                <i class="fas fa-arrow-down"></i> Front of Bus
            </div>

            <!-- Seats Grid (4 columns with aisle) -->
            <div class="grid grid-cols-5 gap-3 mb-6">
                @php
                    $seatNumber = 1;
                    $rows = ceil($totalSeats / 4); // 4 seats per row
                @endphp
                
                @for($row = 0; $row < $rows; $row++)
                    @for($col = 0; $col < 5; $col++)
                        @if($col == 2)
                            <!-- Aisle space in the middle -->
                            <div class="flex items-center justify-center text-gray-400">
                                <i class="fas fa-arrows-alt-v"></i>
                            </div>
                        @else
                            @if($seatNumber <= $totalSeats)
                                @php
                                    $seat = $seats[$seatNumber];
                                    $status = $seat['status'];
                                    $isBooked = $status === 'booked';
                                    $isOnHold = $status === 'on_hold';
                                    $isAvailable = $status === 'available';
                                    
                                    if ($isBooked) {
                                        $bgColor = 'bg-red-500';
                                        $cursor = 'cursor-not-allowed';
                                        $iconClass = 'fa-lock';
                                    } elseif ($isOnHold) {
                                        $bgColor = 'bg-yellow-500';
                                        $cursor = 'cursor-not-allowed';
                                        $iconClass = 'fa-clock';
                                    } else {
                                        $bgColor = 'bg-green-500';
                                        $cursor = 'cursor-pointer hover:bg-green-600';
                                        $iconClass = '';
                                    }
                                @endphp
                                
                                <div 
                                    class="seat-item relative rounded-lg shadow-lg p-4 transition duration-200 transform hover:scale-105 {{ $bgColor }} {{ $cursor }}"
                                    data-seat="{{ $seatNumber }}"
                                    data-status="{{ $status }}"
                                    data-expires="{{ $seat['expires_at'] ?? '' }}"
                                    onclick="{{ $isAvailable ? 'selectSeat(' . $seatNumber . ')' : '' }}"
                                >
                                    <div class="text-center pointer-events-none">
                                        <i class="fas fa-chair text-white text-xl mb-1"></i>
                                        <div class="text-white font-bold">{{ $seatNumber }}</div>
                                    </div>
                                    @if($iconClass)
                                        <div class="absolute top-1 right-1">
                                            <i class="fas {{ $iconClass }} text-white text-xs"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                @php $seatNumber++; @endphp
                            @endif
                        @endif
                    @endfor
                @endfor
            </div>

            <!-- Bus Back Section -->
            <div class="text-center p-4 bg-gray-100 rounded-lg">
                <div class="text-gray-600 font-semibold">
                    <i class="fas fa-arrow-up"></i> Back of Bus
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Information -->
    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mt-8 rounded-lg">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-blue-500 text-2xl mr-4 mt-1"></i>
            <div>
                <h4 class="font-bold text-gray-800 mb-2">How to Book:</h4>
                <ul class="text-gray-700 space-y-1">
                    <li>• Click on a <span class="text-green-600 font-semibold">green seat</span> to select it</li>
                    <li>• <span class="text-yellow-600 font-semibold">Yellow seats</span> are temporarily held by other users (10 min)</li>
                    <li>• <span class="text-red-600 font-semibold">Red seats</span> are confirmed bookings</li>
                    <li>• You can only book <span class="font-semibold">one seat</span> at a time</li>
                    <li>• Once you proceed to payment, the seat will be <span class="text-yellow-600 font-semibold">held for 10 minutes</span></li>
                    <li>• Complete payment within 10 minutes or your hold will expire</li>
                    <li>• Entry/Exit door is located on the <span class="font-semibold">left side</span> of the bus</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="text-center mt-8">
        <a href="{{ url()->previous() }}" class="inline-flex items-center bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Routes
        </a>
    </div>
</div>

<!-- Booking Confirmation Modal -->
<div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-t-lg">
            <h3 class="text-2xl font-bold flex items-center">
                <i class="fas fa-ticket-alt mr-3"></i>
                Confirm Your Booking
            </h3>
        </div>
        
        <div class="p-6">
            <!-- Route Info -->
            <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-gray-600">Route:</span>
                    <span class="font-semibold text-gray-800">{{ $route->route_name }}</span>
                </div>
                <div class="flex items-center justify-between mb-2">
                    <span class="text-gray-600">From:</span>
                    <span class="font-semibold text-gray-800">{{ $route->pickup_location }}</span>
                </div>
                <div class="flex items-center justify-between mb-2">
                    <span class="text-gray-600">To:</span>
                    <span class="font-semibold text-gray-800">{{ $route->dropoff_location }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Departure:</span>
                    <span class="font-semibold text-gray-800">{{ date('g:i A', strtotime($route->departure_time)) }}</span>
                </div>
            </div>

            <!-- Selected Seat -->
            <div class="mb-6 bg-blue-50 p-4 rounded-lg border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-chair text-blue-600 text-2xl mr-3"></i>
                        <div>
                            <div class="text-sm text-gray-600">Selected Seat</div>
                            <div class="text-2xl font-bold text-blue-600" id="selectedSeatNumber">-</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-600">Fare</div>
                        <div class="text-2xl font-bold text-green-600">৳{{ number_format($route->fare, 0) }}</div>
                    </div>
                </div>
            </div>

            <!-- Date and Time -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-calendar-check mr-2 text-blue-600"></i>Journey Date
                </label>
                <input 
                    type="date" 
                    id="bookingDate" 
                    value="{{ $date }}"
                    min="{{ date('Y-m-d') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                <p class="text-xs text-gray-500 mt-1">
                    <i class="fas fa-info-circle mr-1"></i>Departure at {{ date('g:i A', strtotime($route->departure_time)) }}
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-3">
                <button 
                    onclick="closeModal()" 
                    class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-4 rounded-lg transition duration-200"
                >
                    Cancel
                </button>
                <button 
                    onclick="confirmBooking()" 
                    class="flex-1 bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-bold py-3 px-4 rounded-lg transition duration-200 shadow-lg"
                >
                    <i class="fas fa-arrow-right mr-2"></i>Proceed to Payment
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let selectedSeat = null;
let holdCheckInterval = null;

// Auto-refresh to show hold status changes
function startAutoRefresh() {
    // Refresh held seats every 30 seconds
    holdCheckInterval = setInterval(() => {
        checkExpiredHolds();
    }, 30000);
}

// Check for expired holds
function checkExpiredHolds() {
    const now = new Date();
    document.querySelectorAll('[data-status="on_hold"]').forEach(seat => {
        const expiresAt = seat.getAttribute('data-expires');
        if (expiresAt && new Date(expiresAt) <= now) {
            // Reload page to reflect changes
            location.reload();
        }
    });
}

function selectSeat(seatNumber) {
    // Get the seat element
    const seatElement = document.querySelector(`[data-seat="${seatNumber}"]`);
    const status = seatElement.getAttribute('data-status');
    
    if (status !== 'available') {
        if (status === 'on_hold') {
            alert('This seat is currently being held by another user. Please try again in a few minutes.');
        }
        return; // Don't allow selecting non-available seats
    }
    
    // Deselect previously selected seat
    if (selectedSeat !== null && selectedSeat !== seatNumber) {
        const previousSeat = document.querySelector(`[data-seat="${selectedSeat}"]`);
        if (previousSeat && previousSeat.getAttribute('data-status') === 'available') {
            previousSeat.classList.remove('bg-blue-500', 'ring-4', 'ring-blue-300');
            previousSeat.classList.add('bg-green-500');
        }
    }
    
    // Select new seat
    if (selectedSeat === seatNumber) {
        // Deselect if clicking the same seat
        seatElement.classList.remove('bg-blue-500', 'ring-4', 'ring-blue-300');
        seatElement.classList.add('bg-green-500');
        selectedSeat = null;
    } else {
        // Select the new seat
        seatElement.classList.remove('bg-green-500');
        seatElement.classList.add('bg-blue-500', 'ring-4', 'ring-blue-300');
        selectedSeat = seatNumber;
        
        // Show booking modal
        showModal(seatNumber);
    }
}

function showModal(seatNumber) {
    document.getElementById('selectedSeatNumber').textContent = seatNumber;
    const modal = document.getElementById('bookingModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal() {
    const modal = document.getElementById('bookingModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    
    // Deselect the seat
    if (selectedSeat !== null) {
        const seatElement = document.querySelector(`[data-seat="${selectedSeat}"]`);
        if (seatElement && seatElement.getAttribute('data-status') === 'available') {
            seatElement.classList.remove('bg-blue-500', 'ring-4', 'ring-blue-300');
            seatElement.classList.add('bg-green-500');
        }
        selectedSeat = null;
    }
}

async function confirmBooking() {
    if (selectedSeat === null) {
        alert('Please select a seat first');
        return;
    }
    
    const bookingDate = document.getElementById('bookingDate').value;
    
    if (!bookingDate) {
        alert('Please select a booking date');
        return;
    }

    // Show loading state
    const confirmBtn = event.target;
    const originalText = confirmBtn.innerHTML;
    confirmBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
    confirmBtn.disabled = true;
    
    try {
        // Hold the seat via API
        const response = await fetch('{{ route("bookings.hold") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                bus_route_id: {{ $route->id }},
                seat_number: selectedSeat,
                booking_date: bookingDate
            })
        });

        const data = await response.json();

        if (data.success) {
            // Store booking info in sessionStorage
            sessionStorage.setItem('pendingBooking', JSON.stringify({
                booking_id: data.booking_id,
                route_id: {{ $route->id }},
                route_name: '{{ $route->route_name }}',
                seat_number: selectedSeat,
                booking_date: bookingDate,
                fare: {{ $route->fare }},
                expires_at: data.expires_at,
                pickup: '{{ $route->pickup_location }}',
                dropoff: '{{ $route->dropoff_location }}',
                departure: '{{ date("g:i A", strtotime($route->departure_time)) }}'
            }));

            // TODO: Redirect to actual payment page
            // For now, show alert
            alert('Seat held successfully for 10 minutes!\n\n' +
                  'Booking ID: ' + data.booking_id + '\n' +
                  'Seat: ' + selectedSeat + '\n' +
                  'Route: {{ $route->route_name }}\n' +
                  'Date: ' + bookingDate + '\n' +
                  'Fare: ৳{{ number_format($route->fare, 0) }}\n\n' +
                  'You have 10 minutes to complete payment.\n' +
                  'Payment page will be created next!');

            // Close modal and reload to show yellow seat
            closeModal();
            location.reload();
        } else {
            alert('Failed to hold seat: ' + data.message);
            confirmBtn.innerHTML = originalText;
            confirmBtn.disabled = false;
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
        confirmBtn.innerHTML = originalText;
        confirmBtn.disabled = false;
    }
}


// Close modal when clicking outside
document.getElementById('bookingModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Handle escape key to close modal
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Start auto-refresh on page load
startAutoRefresh();

// Cleanup on page unload
window.addEventListener('beforeunload', function() {
    if (holdCheckInterval) {
        clearInterval(holdCheckInterval);
    }
});
</script>

@endsection
