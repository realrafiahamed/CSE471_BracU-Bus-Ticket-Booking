<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
        }

        .container {
            width: 90%;
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: 600;
            color: #444;
            display: block;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-top: 5px;
            transition: 0.2s;
        }

        input:focus {
            border-color: #6a11cb;
            outline: none;
            box-shadow: 0 0 4px #6a11cb88;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            opacity: 0.9;
            transform: scale(1.02);
        }

        .success {
            background: #d4edda;
            padding: 10px;
            border-radius: 5px;
            color: #155724;
            margin-bottom: 15px;
            text-align: center;
        }

        .error {
            background: #f8d7da;
            padding: 10px;
            border-radius: 5px;
            color: #721c24;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Change Password</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        
        @php $user = auth()->user(); @endphp

        @if(!$user->is_google_user)
        <label>Current Password</label>
        <input type="password" name="current_password" placeholder="Current Password" required>
        @endif

        <label>New Password</label>
        <input type="password" name="password" required>

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>
    </form>
        <button type="submit">Update Password</button>
        <form action="{{ route('dashboard') }}" method="get"><button type="submit">Dashboard</button></form>
</div>

</body>
</html>