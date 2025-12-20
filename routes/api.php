<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;

// List all students (with optional search)
Route::get('/students', [StudentController::class, 'index']);

// Get a single student by ID
Route::get('/students/{id}', [StudentController::class, 'show']);