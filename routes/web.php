<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\LoginController;

// ------------------- Your original routes -------------------

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/change-password', [ProfileController::class, 'showForm'])->name('password.change');
Route::post('/change-password', [PasswordController::class, 'update'])->name('password.update');

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/2fa-verify', [OTPController::class, 'showVerifyForm'])->name('2fa.verify.form');
Route::post('/2fa-verify', [OTPController::class, 'verifyOtp'])->name('2fa.verify');

Route::get('/2fa/password', [OTPController::class, 'passwordForm'])->name('2fa.password.form');
Route::post('/2fa/verify-password', [OTPController::class, 'verifyPassword'])->name('2fa.verify.password');
Route::post('/2fa/toggle', [OTPController::class, 'toggle2FA'])->name('2fa.toggle');

require __DIR__.'/auth.php';

// ------------------- Subah's routes integrated -------------------

// Student Dashboard route (adapted to your users table)
Route::get('/api/students', [StudentController::class, 'index']);
Route::get('/api/students/{id}', [StudentController::class, 'show']);

Route::get('/student/dashboard/{user_id}', function ($user_id) {
    $user = \App\Models\User::where('user_id', $user_id)->first();
    if (!$user) {
        abort(404, "User not found");
    }

    $recentBookings = collect([
        (object) ['from_location'=>'Campus','to_location'=>'Mirpur','journey_date'=>now()->addHours(2),'status'=>'confirmed'],
        (object) ['from_location'=>'Campus','to_location'=>'Uttara','journey_date'=>now()->subDay(),'status'=>'cancelled'],
        (object) ['from_location'=>'Campus','to_location'=>'Mirpur','journey_date'=>now()->addDay(),'status'=>'confirmed'],
    ]);

    $notifications = collect([
        (object) ['title'=>'Bus Delay','message'=>'Bus will arrive late.','is_read'=>false,'created_at'=>now()->subHours(2)],
        (object) ['title'=>'Booking Confirmed','message'=>'Your booking Campus → Mirpur is confirmed.','is_read'=>true,'created_at'=>now()->subDays(1)],
        (object) ['title'=>'Route Notice','message'=>'Evening shuttle from Campus to Malibag will not run this Friday.','is_read'=>false,'created_at'=>now()->subHours(10)],
    ]);

    return view('student.dashboard', [
        'user' => $user,
        'recentBookings' => $recentBookings,
        'notifications' => $notifications,
    ]);
})->name('student.dashboard');

// Admin login/profile routes
Route::get('/admin/login',[LoginController::class,'showLoginForm'])->name('admin.login');
Route::post('/admin/login',[LoginController::class,'login'])->name('admin.login.submit');
Route::get('/admin/logout',[LoginController::class,'logout'])->name('admin.logout');

Route::middleware('auth:admin')->group(function(){
    Route::get('/admin/dashboard',[AdminProfileController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profile',[AdminProfileController::class,'profile'])->name('admin.profile');
    Route::get('/admin/profile/edit',[AdminProfileController::class,'edit'])->name('admin.profile.edit');
    Route::post('/admin/profile',[AdminProfileController::class,'update'])->name('admin.profile.update');
    Route::get('/admin/students', [AdminProfileController::class,'dashboard'])->name('admin.students.index');
    Route::get('/admin/notifications', function () {
    // Fetch students or users you can send notifications to
    $users = \App\Models\User::all(); 
    return view('admin.students.index', compact('users'));
})->name('admin.notifications.page');

// Admin routes (adapted to your users table)
Route::get('/admin/students/{user_id}', function ($user_id) {
    $user = \App\Models\User::findOrFail($user_id);
    return view('admin.students.show', compact('user'));
})->name('admin.students.show');

Route::get('/admin/students/{user_id}/edit', function ($user_id) {
    $student = \App\Models\User::findOrFail($user_id);
    return view('admin.students.edit', compact('student'));
})->name('admin.students.edit');

Route::put('/admin/students/{user_id}', function ($user_id, Request $request) {
    $user = \App\Models\User::findOrFail($user_id);

    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->email = $request->email;
    $user->department = $request->department;

    $user->save();

    return redirect()->route('admin.students.show', $user->user_id)
                     ->with('success', 'User updated successfully!');
})->name('admin.students.update');

});
