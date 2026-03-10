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
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email',
            'subject' => 'required|string|max:255',
        ]);

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make('teacher@123'), // ✅ REQUIRED
            'role'       => 'teacher',                  // ✅ REQUIRED
            'subject'    => $request->subject,
        ]);

        return redirect('/admin/users')
            ->with('success', 'Teacher created successfully');
    }
}
