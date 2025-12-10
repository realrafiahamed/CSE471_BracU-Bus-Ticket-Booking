<?php

use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Http\Request;

// Homepage route
Route::get('/', function () {
    return view('welcome');
});

// Student Dashboard route
//Route::get('/student/dashboard', function () {
Route::get('/student/dashboard/{student_id}', function ($student_id) {
    // Fetch the first student from the database
    //$user = Student::first();
     $user = Student::where('student_id', $student_id)->first();
    // Fallback if no student is found
    //if (!$user) {
        //$user = (object) [
            //'name' => 'Student',
            //'email' => 'student@example.com',
            //'student_id' => 'N/A',
            //'department' => 'N/A',
            //'status' => 'active',
        //];
    
    if (!$user) {
        abort(404, "Student not found");
    }
    

    // Mock recent bookings (replace with DB later if needed)
    $recentBookings = collect([
        (object) ['from_location'=>'Hostel Gate','to_location'=>'Main Academic Block','journey_date'=>now()->addHours(2),'status'=>'confirmed'],
        (object) ['from_location'=>'Main Gate','to_location'=>'Library Stop','journey_date'=>now()->subDay(),'status'=>'cancelled'],
        (object) ['from_location'=>'Sports Complex','to_location'=>'Hostel Gate','journey_date'=>now()->addDay(),'status'=>'confirmed'],
    ]);

    // Mock notifications (replace with DB later if needed)
    $notifications = collect([
        (object) ['title'=>'Shuttle Delay','message'=>'Hostel → Main Academic Block shuttle delayed by 10 minutes.','is_read'=>false,'created_at'=>now()->subHours(2)],
        (object) ['title'=>'Booking Confirmed','message'=>'Your booking Main Gate → Library Stop is confirmed.','is_read'=>true,'created_at'=>now()->subDays(1)],
        (object) ['title'=>'Route Notice','message'=>'Evening shuttle from Sports Complex will not run this Friday.','is_read'=>false,'created_at'=>now()->subHours(10)],
    ]);

    // Pass data to the view
    return view('student.dashboard', [
        'user' => $user,
        'recentBookings' => $recentBookings,
        'notifications' => $notifications,
    ]);
})->name('student.dashboard');


Route::get('/api/students', [StudentController::class, 'index']);

// Get a single student
Route::get('/api/students/{id}', [StudentController::class, 'show']);

Route::get('/admin/students', function () {
    return view('admin.students.index');
})->name('admin.students.index');


Route::get('/admin/students/{id}', function ($id) {
    $student = Student::findOrFail($id);
    return view('admin.students.show', compact('student'));
})->name('admin.students.show');

// Edit student page (prefilled with DB data; save is dummy)
Route::get('/admin/students/{id}/edit', function ($id) {
    $student = Student::findOrFail($id);
    return view('admin.students.edit', compact('student'));
})->name('admin.students.edit');

Route::put('/admin/students/{id}', function ($id, Request $request) {
    $student = Student::findOrFail($id);

    $student->name = $request->name;
    $student->student_id = $request->student_id;
    $student->email = $request->email;
    $student->department = $request->department;
    $student->status = $request->status;

    $student->save();

    return redirect()->route('admin.students.show', $student->id)
                     ->with('success', 'Student updated successfully!');
})->name('admin.students.update');