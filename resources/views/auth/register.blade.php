<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Register - BracU Bus Booking</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    * { margin:0; padding:0; box-sizing:border-box; font-family:'Inter',sans-serif; }
    body, html { height:100%; width:100%; background:#fdf8f3; overflow:hidden; }

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
        background: linear-gradient(135deg, rgba(255, 107, 107, 0.78), rgba(255, 159, 128, 0.72), rgba(255, 204, 153, 0.68));
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
        color: black;
        font-size:48px;
        font-weight:700;
        margin-bottom:20px;
        letter-spacing:-0.5px;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInText 0.8s ease-out 0.6s forwards;
    }
    .left-content p {
        color:navy;
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
        align-items: flex-start;
        justify-content: center;
        background: #f9fafc;
        padding: 40px 30px 20px 30px;
        overflow: hidden;
        height: 100vh;
    }

    .right-side:hover {
        background: #f3e8ff;
    }

    .register-box {
        width:100%;
        max-width: 380px;
        height: 90vh;
        padding:20px;
        background:white;
        border-radius:16px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1), 0 0 0 1px rgba(0,0,0,0.05); /* Enhanced shadow for depth */
        display: flex;
        flex-direction: column;
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
        flex-shrink: 0;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        opacity: 0;
        animation: fadeInText 0.8s ease-out 0.2s forwards;
    }
    
    .form-scroll {
        flex: 1;
        overflow-y: auto;
        padding-right: 8px; 
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
        padding:14px;
        background: linear-gradient(90deg, #0d6efd, #0b5ed7);
        color:white;
        border:none;
        border-radius:8px;
        cursor:pointer;
        font-size:16px;
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
            <h1>Welcome to BracU Bus Booking</h1>
            <p>Streamline your commute with seamless bus reservations. Register now to start your journey.</p>
        </div>
    </div>
    <div class="right-side">
        <div class="register-box">
            <h2>Create Account</h2>
                @if ($errors->any())
            <div class="errors">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
            <div class="form-scroll">
            <form method="POST" action="{{ url('/register') }}" autocomplete="off">
                @csrf
                <input type="text" name="first_name" placeholder="First Name" required value="{{ old('first_name') }}" />
                <input type="text" name="last_name" placeholder="Last Name" required value="{{ old('last_name') }}"/>
                <input type="email" name="email" placeholder="University Gsuit Email" required />
                <input type="tel" name="phone_no" placeholder="Phone Number" required />
                <select name="default_location" required>
                    <option value="" disabled selected>Select location</option>
                    <option value="Abdullahpur">Abdullahpur</option>
                    <option value="House Building">House Building</option>
                    <option value="Azampur">Azampur</option>
                </select>
                <input type="text" name="department" placeholder="Department" required />
                <input type="text" name="student_id" placeholder="Student ID" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
                <button type="submit">Register</button>
            </form>
        </div>
            
            <div class="login-link">
                Already have an account? <a href="{{route('login')}}">Login</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>