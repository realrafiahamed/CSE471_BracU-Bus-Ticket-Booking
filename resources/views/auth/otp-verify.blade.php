<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen font-sans">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-700">Enter OTP</h2>
        <p class="mb-4 text-center text-gray-600">Enter the 6-digit OTP sent to your email</p>

        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('2fa.verify') }}">
            @csrf
            <div class="mb-4">
                <input type="text" name="otp" placeholder="6-digit OTP"
                       class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <button type="submit"
                    class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700 transition">
                Verify
            </button>
        </form>

        <p class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Cancel</a>
        </p>
    </div>

</body>
</html>

