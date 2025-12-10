<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BRACU Transport Ticket Booking System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <i class="fas fa-bus text-white text-3xl"></i>
                    <div>
                        <h1 class="text-white text-2xl font-bold">BRACU Transport</h1>
                        <p class="text-blue-200 text-sm">Ticket Booking System</p>
                    </div>
                </a>
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="text-white hover:text-blue-200 transition duration-300 font-medium">
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                    <a href="{{ route('bus-routes.all') }}" class="text-white hover:text-blue-200 transition duration-300 font-medium">
                        <i class="fas fa-list mr-2"></i>All Routes
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16 py-8">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-400">© 2024 BRACU Transport Ticket Booking System</p>
            <p class="text-gray-500 text-sm mt-2">BRAC University, Merul Badda, Dhaka</p>
        </div>
    </footer>
</body>
</html>
