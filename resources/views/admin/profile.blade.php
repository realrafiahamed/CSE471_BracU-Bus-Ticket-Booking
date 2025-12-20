<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile - BRACU Transport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .card {
            border-radius: 1rem;
        }
        .card-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #0d6efd;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #0d6efd;
        }
        .btn-custom {
            border-radius: 50px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary">Admin Profile</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm mx-auto" style="max-width: 650px;">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row align-items-center">
                <!-- Profile Image -->
                <div class="me-md-4 mb-3 mb-md-0 text-center">
                    @if($admin->photo)
                        <img src="{{ asset($admin->photo) }}" width="150" class="rounded-circle">
                    @else
                        <img src="{{ asset('images/default-avatar.png') }}" width="150" class="rounded-circle">
                    @endif
                </div>

                <!-- Admin Info -->
                <div class="flex-grow-1">
                    <h5 class="card-title">{{ $admin->name }}</h5>
                    <p class="mb-1"><strong>Email:</strong> {{ $admin->email }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $admin->phone ?? 'Not Provided' }}</p>
                    <p class="mb-3"><strong>Address:</strong> {{ $admin->address ?? 'Not Provided' }}</p>
                    
                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary btn-custom w-100 w-sm-auto">Edit Profile</a>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-custom w-100 w-sm-auto">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
