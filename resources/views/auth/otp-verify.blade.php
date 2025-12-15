<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
</head>
<body>
<h2>Enter OTP sent to your email</h2>

@if($errors->any())
    <div style="color:red">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('2fa.verify')}}">
    @csrf
    <input type="text" name="otp" placeholder="6-digit OTP" required>
    <button type="submit">Verify</button>
</form>
</body>
</html>
