<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login - BracU Bus Booking</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    * { margin:0; padding:0; box-sizing:border-box; font-family:'Inter',sans-serif; }
    body, html { height:100%; width:100%; background:#f9fafc; overflow:hidden; }

    .container {
        display: flex;
        height: 100vh;
        width: 100%;
    }

    /* Left side - 70% width */
    .left-side {
        flex: 7;
        background: url('/bus.jpg') no-repeat center center/cover;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        padding: 60px;
        overflow: hidden; /* Added for smoother animations */
    }
    .left-side::after {
        content: "";
        position: absolute;
        top:0; left:0; width:100%; height:100%;
        background: linear-gradient(to bottom, rgba(13,110,253,0.6), rgba(11,94,215,0.4)); /* Changed to professional blue tones */
        z-index:1;
    }
    .left-content {
        position: relative;
        z-index:2;
        max-width:80%;
        opacity: 0;
        transform: translateY(30px);
        animation: slideUpFadeIn 1s ease-out 0.3s forwards;
    }
    .left-content h1 {
        font-size:48px;
        font-weight:700;
        margin-bottom:20px;
        letter-spacing:-0.5px;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInText 0.8s ease-out 0.6s forwards;
    }
    .left-content p {
        font-size:18px;
        font-weight:400;
        line-height:1.6;
        opacity:0;
        transform: translateY(20px);
        animation: fadeInText 0.8s ease-out 0.9s forwards;
    }

    /* Right side - 30% width */
    .right-side {
        flex:3;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f9fafc;
        padding: 110px 30px 30px 30px;
        overflow-y: auto;
        height: 100vh;
    }

    .register-box {
        width:100%;
        max-width: 380px;
        padding:30px 20px;
        background:white;
        border-radius:16px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1), 0 0 0 1px rgba(0,0,0,0.05); /* Enhanced shadow for depth */
        animation: fadeInScale 1s ease-out;
        transition: box-shadow 0.3s ease; /* Smooth shadow transition */
    }
    .register-box:hover {
        box-shadow: 0 25px 50px rgba(0,0,0,0.15), 0 0 0 1px rgba(0,0,0,0.05); /* Subtle hover lift */
    }
    
    @keyframes fadeInScale {
        0% { opacity:0; transform: translateY(20px) scale(0.98); }
        100% { opacity:1; transform: translateY(0) scale(1); }
    }
    @keyframes slideUpFadeIn {
        0% { opacity:0; transform: translateY(30px); }
        100% { opacity:1; transform: translateY(0); }
    }
    @keyframes fadeInText {
        0% { opacity:0; transform: translateY(20px); }
        100% { opacity:1; transform: translateY(0); }
    }
    .register-box h2 {
        text-align:center;
        font-size:32px;
        font-weight:700;
        color:#0d6efd;
        letter-spacing: 1px;
        margin-bottom:16px;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        opacity: 0;
        animation: fadeInText 0.8s ease-out 0.2s forwards;
    }
    .register-box p.subtitle {
        text-align:center;
        font-size:16px;
        color:#475467;
        margin-bottom:24px;
        opacity: 0;
        animation: fadeInText 0.8s ease-out 0.4s forwards;
    }
    .register-box input, .register-box select {
        width:100%;
        padding:12px 16px;
        margin:8px 0 16px;
        border:1px solid #d0d5dd;
        border-radius:8px;
        font-size:16px;
        transition: all 0.3s ease; /* Smoother transition */
        background: #f9fafc;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.05); /* Subtle inset shadow */
    }
    .register-box input:focus, .register-box select:focus {
        border-color:#0d6efd;
        box-shadow:0 0 0 3px rgba(13,110,253,0.1), inset 0 1px 3px rgba(0,0,0,0.1);
        outline:none;
        transform: translateY(-1px); /* Subtle lift on focus */
    }
    .register-box button {
        width:100%;
        padding:8px;
        background: linear-gradient(90deg, #0d6efd, #0b5ed7);
        color:white;
        border:none;
        border-radius:8px;
        cursor:pointer;
        font-size:20px;
        font-weight:600;
        margin-top:16px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(13,110,253,0.2); /* Added button shadow */
    }
    .register-box button:hover {
        background: linear-gradient(90deg, #0b5ed7, #094bb5);
        transform: translateY(-2px) scale(1.02); /* Enhanced hover with scale */
        box-shadow: 0 6px 12px rgba(13,110,253,0.3);
    }
    .register-box button:active {
        transform: translateY(0) scale(1); /* Active state feedback */
        box-shadow: 0 2px 4px rgba(13,110,253,0.2);
    }
    .register-box button.google-btn {
        background: linear-gradient(90deg, #C45A5A, #D66F6F);
        box-shadow: 0 4px 8px rgba(196, 90, 90, 0.25);
        margin-top: 12px;
    }
    .register-box button.google-btn:hover {
        background: linear-gradient(90deg, #A53F3F, #B84D4D);
        box-shadow: 0 8px 18px rgba(165, 63, 63, 0.4);
        transform: translateY(-2px) scale(1.02);
    }
    .register-box button.google-btn:active {
        transform: translateY(0) scale(1);
        box-shadow: 0 4px 8px rgba(165, 63, 63, 0.3);
    }
    .login-link { 
        margin-top:20px; 
        text-align:center; 
        font-size:14px; 
        color:#475467; 
        opacity: 0;
        animation: fadeInText 0.8s ease-out 1.2s forwards;
    }
    .login-link a { 
        color:#0d6efd; 
        font-weight:600; 
        text-decoration:none; 
        transition: color 0.2s ease;
    }
    .login-link a:hover { 
        text-decoration:underline; 
        color: #094bb5;
    }
    .login-link .separator {
        margin: 0 5px;
    }
    .errors {
        background:#fee4e2;
        color:#b80000;
        padding:12px 16px;
        border-radius:8px;
        margin-bottom:20px;
        font-size:14px;
        border:1px solid #fecdca;
        opacity: 0;
        transform: translateY(-10px);
        animation: errorShake 0.5s ease-out forwards;
    }
    @keyframes errorShake {
        0% { opacity:0; transform: translateY(-10px); }
        20% { transform: translateY(0) translateX(-2px); }
        40% { transform: translateX(2px); }
        60% { transform: translateX(-2px); }
        80% { transform: translateX(2px); }
        100% { opacity:1; transform: translateX(0); }
    }

    /* Responsive */
    @media (max-width:1440px){
        .left-side h1{ font-size:40px;}
        .left-side p{ font-size:16px;}
        .register-box { max-width:350px; padding:35px 25px;}
    }
    @media (max-width:1024px){
        .container { flex-direction:column; }
        .left-side { flex:none; height:35vh; padding:30px; }
        .right-side { flex:none; height:65vh; padding:30px 20px; }
    }
    @media (max-width:480px){
        .left-side { height:25vh; padding:20px;}
        .left-content h1{ font-size:28px;}
        .left-content p{ font-size:14px;}
        .register-box { padding:25px 15px; max-width:95%; }
        .register-box h2 { font-size:28px; }
        .register-box p.subtitle { font-size:14px; }
    }
</style>
</head>
<body>
<div class="container">
    <div class="left-side">
        <div class="left-content">
            <h1>Welcome Back to BracU Bus Booking</h1>
            <p>Access your commute with seamless bus reservations. Login now to continue your journey.</p>
        </div>
    </div>
    <div class="right-side">
        <div class="register-box">
            <h2>Sign In</h2>
            @if ($errors->any())
            <div class="errors">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ url('/login') }}" autocomplete="off">
                @csrf
                <input type="text" name="login" placeholder="University Gsuit Email or Phone" required value="{{old('login') }}" />
                <input type="password" name="password" placeholder="Password" required />
                <button type="submit">Sign In</button>
            </form>
            <div style="margin-bottom: 5px;"></div>
            <button type="button" class="google-btn" onclick="window.location='{{ url('/auth/google') }}'">Login with Google</button>

            <div class="login-link">
                
                Don't have an account? <a href="/register">Register</a>
                <span class="separator">|</span><br>
                <a href="/admin/login">Click for Admin Login</a>
                <span class="separator">|</span>
                <a href="{{ route('password.request') }}">Forgot Password?</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>