<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

<!-- NAVBAR -->
<nav class="bg-blue-700 text-white p-4 flex justify-between items-center shadow-lg">
    <h1 class="text-2xl font-bold">Student Dashboard</h1>

    <div class="flex items-center space-x-4">
        <span class="font-semibold">Hello, {{ auth()->user()->first_name }}</span>

        <div class="relative">
            <button id="dropdownButton"
                class="bg-white text-black px-3 py-1 rounded font-semibold hover:bg-blue-100">
                Account ▾
            </button>

            <div id="dropdownMenu"
                class="hidden absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-lg border z-50">

                <form action="{{ route('profile.edit') }}" method="GET">
                    <button class="w-full text-left px-4 py-2 hover:bg-blue-600 hover:text-white">
                        Edit Profile
                    </button>
                </form>

                <form action="{{ route('password.change') }}" method="GET">
                    <button class="w-full text-left px-4 py-2 hover:bg-blue-600 hover:text-white">
                        Change Password
                    </button>
                </form>

                <form action="{{ route('password.change') }}" method="GET">
                    <button class="w-full text-left px-4 py-2 hover:bg-blue-600 hover:text-white">
                        Change Password
                    </button>
                </form>

                <form action="{{ route('2fa.password.form') }}" method="GET">
                    <button class="w-full text-left px-4 py-2 hover:bg-blue-600 hover:text-white">
                        {{ auth()->user()->two_factor_enabled ? 'Disable 2FA' : 'Enable 2FA' }}
                    </button>
                </form>


                <form action="{{ route('profile.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="w-full text-left px-4 py-2 hover:bg-red-600 hover:text-white">
                        Delete Profile
                    </button>
                </form>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="w-full text-left px-4 py-2 hover:bg-gray-800 hover:text-white">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="max-w-6xl mx-auto p-6">

    <!-- WELCOME -->
    <div class="bg-white shadow-md rounded-xl p-6 mb-6 border-l-4 border-blue-600">
        <h2 class="text-xl font-bold text-blue-800">
            Welcome Back, {{ auth()->user()->first_name }}!
        </h2>
    </div>

    <!-- GRID -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- ACCOUNT INFO -->
        <div class="bg-white p-5 shadow-lg rounded-xl">
            <h3 class="text-lg font-bold mb-4 text-blue-700">Account Information</h3>
            <div class="space-y-3 text-gray-700">
                <p><strong>Name:</strong> {{ auth()->user()->first_name }} {{ auth()->user()->last_name ?? '' }}</p>
                <p><strong>Student ID:</strong> {{ auth()->user()->student_id }}</p>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p><strong>Department:</strong> {{ auth()->user()->department ?? 'N/A' }}</p>
                <p><strong>Status:</strong>
                    <span class="text-green-600 font-semibold">
                        {{ ucfirst(auth()->user()->status) }}
                    </span>
                </p>
            </div>
        </div>

        <!-- RECENT BOOKINGS -->
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
                    @forelse($recentBookings ?? [] as $booking)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                            <td class="border p-2">{{ $booking->journey_date }}</td>
                            <td class="border p-2">{{ $booking->from_location }} → {{ $booking->to_location }}</td>
                            <td class="border p-2 font-semibold">
                                {{ ucfirst($booking->status) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="border p-2 text-center text-gray-500">
                                No bookings found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- NOTIFICATIONS -->
    <div class="bg-white p-5 mt-6 shadow-lg rounded-xl">
        <h3 class="text-lg font-bold mb-4 text-blue-700">Notifications</h3>

        <ul class="space-y-3 text-gray-700">
            @forelse($notifications ?? [] as $notification)
                <li class="p-3 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                    <strong>{{ $notification->title }}:</strong>
                    {{ $notification->message }}
                </li>
            @empty
                <li class="p-3 text-center text-gray-500">
                    No notifications found
                </li>
            @endforelse
        </ul>
    </div>

</div>

<!-- DROPDOWN SCRIPT -->
<script>
    const btn = document.getElementById('dropdownButton');
    const menu = document.getElementById('dropdownMenu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>

</body>
</html>
