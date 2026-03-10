<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        $login = $request->login;
        $password = $request->password;

        // Try email login
        if (Auth::attempt(['email' => $login, 'password' => $password])) {
            $request->session()->regenerate();
            return $this->redirectByRole();
        }

        // Try roll number login
        if (Auth::attempt(['roll_no' => $login, 'password' => $password])) {
            $request->session()->regenerate();
            return $this->redirectByRole();
        }

        return back()->withErrors([
            'login' => 'Invalid credentials',
        ]);
    }

    private function redirectByRole()
    {
        $user = auth()->user();

        if (!$user) {
            Auth::logout();
            return redirect('/login');
        }

        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        if ($user->role === 'teacher') {
            return redirect('/teacher/dashboard');
        }

        return redirect('/dashboard'); // student
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
