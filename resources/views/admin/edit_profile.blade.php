<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin Profile - BRACU Transport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .form-label {
            font-weight: 600;
        }
        .btn-custom {
            border-radius: 50px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary">Edit Profile</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card mx-auto p-4" style="max-width: 650px;">
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $admin->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $admin->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" name="password" class="form-control" placeholder="Leave blank if not changing">
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $admin->phone ?? '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="3">{{ $admin->address ?? '' }}</textarea>
            </div>
          

         
            <!-- Profile Avatar 
            <div class="mb-3">
                <label>Profile Avatar</label>
                <input type="file" name="avatar" class="form-control">
                <div class="mt-2">
                   @if($admin->photo)
                       <img src="{{ asset($admin->photo) }}" width="150" class="rounded-circle">
                   @else
                       <img src="{{ asset('images/default-avatar.png') }}" width="150" class="rounded-circle">
                   @endif
                </div>
            </div>
            -->
        


            <div class="d-flex flex-column flex-sm-row gap-2">
                <button type="submit" class="btn btn-success btn-custom w-100 w-sm-auto">Update Profile</button>
                <a href="{{ route('admin.profile') }}" class="btn btn-secondary btn-custom w-100 w-sm-auto">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
