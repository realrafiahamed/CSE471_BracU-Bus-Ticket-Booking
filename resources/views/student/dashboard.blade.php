<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>

    
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    
    <nav class="bg-blue-700 text-white p-4 flex justify-between items-center shadow-lg">
        <h1 class="text-2xl font-bold">Student Dashboard</h1>
        <div class="flex items-center space-x-4">
            <span class="font-semibold">Hello, {{ $user->name }}</span>
            <img src="https://via.placeholder.com/40" class="rounded-full" alt="Profile">
        </div>
    </nav>

    
    <div class="max-w-6xl mx-auto p-6">

        
        <div class="bg-white shadow-md rounded-xl p-6 mb-6 border-l-4 border-blue-600">
            <h2 class="text-xl font-bold text-blue-800">Welcome Back, {{ $user->name }}!</h2>
            
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <
            <div class="bg-white p-5 shadow-lg rounded-xl">
                <h3 class="text-lg font-bold mb-4 text-blue-700">Account Information</h3>

                <div class="space-y-3 text-gray-700">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Student ID:</strong> {{ $user->student_id }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Department:</strong> {{ $user->department ?? 'N/A' }}</p>
                    <p><strong>Account Status:</strong> 
                        <span class="text-green-600 font-semibold">{{ ucfirst($user->status) }}</span>
                    </p>
                </div>
            </div>

            
            <div class="bg-white p-5 shadow-lg rounded-xl md:col-span-2">
                <h3 class="text-lg font-bold mb-4 text-blue-700">Recent Bookings</h3>

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-blue-100">
                            <th class="border p-2 text-left">Date</th>
                            <th class="border p-2 text-left">Route</th>
                            <th class="border p-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentBookings as $booking)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                            <td class="border p-2">{{ \Carbon\Carbon::parse($booking->journey_date)->format('Y-m-d') }}</td>
                            <td class="border p-2">{{ $booking->from_location }} → {{ $booking->to_location }}</td>
                            <td class="border p-2 
                                {{ $booking->status == 'confirmed' ? 'text-green-600' : ($booking->status == 'cancelled' ? 'text-red-600' : 'text-yellow-600') }} 
                                font-semibold">
                                {{ ucfirst($booking->status) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        
        <div class="bg-white p-5 mt-6 shadow-lg rounded-xl">
            <h3 class="text-lg font-bold mb-4 text-blue-700">Notifications</h3>

            <ul class="space-y-3 text-gray-700">
                @foreach($notifications as $notification)
                <li class="p-3 bg-gray-50 rounded-lg border-l-4 
                    {{ $notification->is_read ? 'border-gray-300' : 'border-blue-500' }}">
                    <strong>{{ $notification->title }}:</strong> {{ $notification->message }}
                </li>
                @endforeach
            </ul>
        </div>

    </div>

</body>
</html>
