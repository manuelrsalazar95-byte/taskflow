<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{   
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {   
        $validatedData = $request->validate([
            'user_name' => 'required|string|max:255|unique:usuarios,user_name',
            'password' => 'required|string|min:8|confirmed',
        ]);
       
        $user = User::create([
            'user_name' => $validatedData['user_name'],
            'password' => $validatedData['password'],
        ]);

        Auth::login($user);
        //Ayuda a regenerar la sesión para evitar ataques de fijación de sesión
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'user_name' => 'Usuario y contraseña incorrectos.'
            ])->onlyInput('user_name');

        }
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}