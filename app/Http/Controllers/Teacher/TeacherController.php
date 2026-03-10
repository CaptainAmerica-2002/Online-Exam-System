<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function store(Request $request)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email|unique:users,email',
            'subject' => 'required|string',
        ]);

        // Auto-generate password
        $plainPassword = 'teacher@123'; // simple for now (demo)

        $teacher = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'subject'  => $request->subject,
            'role'     => 'teacher',
            'password' => Hash::make($plainPassword),
        ]);

        return redirect('/admin/create-teacher')
            ->with('success', 'Teacher created successfully. Password: '.$plainPassword);
    }
}
