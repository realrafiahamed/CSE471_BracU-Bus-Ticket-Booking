<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="max-w-4xl mx-auto p-6">

    <!-- Back Button -->
    <a href="{{ url('/admin/students') }}"
       class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition mb-6">
        Back to Dashboard
    </a>

    <!-- Student Info Card -->
    <div class="bg-white shadow-2xl rounded-2xl p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-blue-700">Student Details</h1>
            <span class="px-4 py-2 rounded-full text-white font-semibold 
                        {{ $student->status === 'active' ? 'bg-green-600' : 'bg-red-600' }}">
                {{ ucfirst($student->status) }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
            <!-- Student Info -->
            <div class="space-y-2">
                <p><strong>Name:</strong> {{ $student->name }}</p>
                <p><strong>Student ID:</strong> {{ $student->student_id }}</p>
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Department:</strong> {{ $student->department ?? '—' }}</p>
            </div>

            <!-- Booking Summary Card -->
            <div class="bg-blue-50 p-6 rounded-xl shadow-inner">
                <h2 class="text-xl font-semibold mb-4 text-blue-700">Booking Summary</h2>
                <div class="space-y-3 text-gray-700">
                    <p><strong>Total Tickets Booked:</strong> 5</p>
                    <p><strong>Total Tickets Cancelled:</strong> 1</p>
                    <p><strong>Last Booking Date:</strong> 2025-12-01</p>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
