<h1>Hi, {{ auth()->user()->first_name }},
    ID {{ auth()->user()->student_id }} - Welcome to Dashboard
</h1>

@auth
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
        window.location.href = "{{ route('dashboard') }}";
    </script>
@endif

<div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">

    <!-- Logout (POST) -->
    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <!-- Edit Profile (GET) -->
    <form action="{{ route('profile.edit') }}" method="GET" style="margin: 0;">
        <button type="submit">Edit Profile</button>
    </form>

    <!-- Change Password (GET) -->
    <form action="{{ route('password.change') }}" method="GET" style="margin: 0;">
        <button type="submit">Change Password</button>
    </form>

    <!-- Delete Profile (DELETE) -->
    <form action="{{ route('profile.destroy') }}" method="POST" style="margin: 0;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Profile</button>
    </form>

</div>
@endauth