<h1>Hi, {{auth()->user()->first_name }}, 
    ID {{auth()->user()->student_id}} -Welcome to Dashboard
</h1>

@auth
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
        window.location.href = "{{ route('dashboard') }}";
    </script>
    <div class="max-w-4xl mx-auto mt-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-md text-center">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit">Logout</button>
</form>

<a href="{{ route('profile.edit') }}">
    <button type="submit">Edit Profile</button></a>

<a href="{{ route('password.change') }}">
    <button type="submit">Change Password</button></a>
@endauth
