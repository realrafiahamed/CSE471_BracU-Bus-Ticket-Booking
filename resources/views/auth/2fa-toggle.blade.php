<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two Factor Authentication</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Two Factor Authentication</h2>

    @if(session('success'))
        <p class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <p class="bg-red-100 text-red-800 p-2 rounded mb-4">{{ $errors->first() }}</p>
    @endif

    @if(!session('2fa:otp') && empty($otp))
    <!-- Password Form -->
    <form method="POST" action="{{ route('2fa.verify.password') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Confirm Password:</label>
            <input type="password" name="password" class="w-full p-2 border rounded" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Continue</button>
    </form>
    @else
    <!-- OTP Confirmation -->
    <p class="mb-4">Enter this code to confirm 2FA toggle: 
        <strong class="text-blue-700">{{ $otp ?? session('2fa:otp') }}</strong>
    </p>
    <form method="POST" action="{{ route('2fa.toggle') }}">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Enter Code:</label>
            <input type="text" name="otp" maxlength="12" class="w-full p-2 border rounded" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Confirm</button>
    </form>
    @endif

    <p class="mt-4 text-center">
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">Cancel</a>
    </p>
</div>

</body>
</html>


