<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = \App\Models\User::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name','like',"%{$search}%")
                    ->orWhere('last_name','like',"%{$search}%")
                    ->orWhere('email','like',"%{$search}%")
                    ->orWhere('student_id','like',"%{$search}%");
            });
        }
        $users = $query->orderBy('first_name')->get();
        return response()->json([
        'total' => $users->count(),
        'data' => $users  ]);
    }

    
    public function show($id)
    {
        $student = \App\Models\User::findOrFail($id);
        return response()->json($student);
    }
}