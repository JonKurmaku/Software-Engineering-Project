<?php

namespace App\Http\Controllers\SignUpControllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Http\Controllers\Controller;

class LecturerController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:lecturers',
            'password' => 'required|string|min:6|confirmed',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'experience' => 'nullable|integer',
            
        ]);

        // Hash the password before storing it in the database
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create a new lecturer instance and persist it to the database
        Lecturer::create($validatedData);

        return redirect()->back()->with('success', 'Lecturer created successfully');
    }
}