<?php

namespace App\Http\Controllers\SignUpControllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Controllers\Controller;


class StudentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:students',
            'email' => 'required|email|max:255|unique:students',
            'password' => 'required|string|min:6|confirmed',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'nullable|string',
            'dob' => 'required|date',
            'country' => 'nullable|string',
            'interests' => 'nullable|string'
        ]);

        // Hash the password before storing it in the database
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create a new student instance and persist it to the database
        Student::create($validatedData);

        return redirect()->back()->with('success', 'Student created successfully');
    }
}