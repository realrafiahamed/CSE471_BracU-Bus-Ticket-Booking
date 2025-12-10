<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Get all students with optional search
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Student::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('student_id', 'like', "%{$search}%");
            });
        }

        return response()->json($query->orderBy('name')->paginate(15));
    }

    // Get a single student by ID
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }
}

