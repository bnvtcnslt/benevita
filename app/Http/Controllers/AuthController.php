<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index(){
        if (auth()->guard('user')->check()) {
            return redirect()->route('dashboard.index');
        }
        return view('auth.index');
    }


    public function verify(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Menambahkan 'remember' untuk "Remember Me"
        $remember = $request->has('remember');

        if (auth()->guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect(route('dashboard.index'));
        } else {
            return redirect(route('auth.index'))->with('pesan', ['type' => 'danger', 'message' => 'Email atau Password Tidak Valid']);
        }
    }

    public function logout(){
        auth()->guard('user')->logout();
        return redirect(route('auth.index'));
    }

    public function forgotPassword(){
        if (auth()->guard('user')->check()) {
            return redirect()->route('dashboard.index');
        }
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('pesan', ['success', 'Reset Password Berhasil. Periksa email Anda.']);
        } else {
            return back()->with('pesan', ['danger', 'Reset Password Gagal. Pastikan email terdaftar.']);
        }
    }
    public function resetPassword($token, Request $request)
    {
        if (auth()->guard('user')->check()) {
            return redirect()->route('dashboard.index');
        }
        $email = $request->email;
        return view('auth.reset-password', ['token' => $token, 'email' => $email]);
    }

    public function updatePassword($token, Request $request)
    {
        $messages = [];

        // Cek jika password kurang dari 8 karakter
        if (strlen($request->password) < 8) {
            $messages[] = 'Password minimal 8 karakter.';
        }

        // Jika password sudah cukup panjang, cek apakah konfirmasi password tidak cocok
        if (strlen($request->password) >= 8 && $request->password !== $request->password_confirmation) {
            $messages[] = 'Konfirmasi password tidak sesuai.';
        }

        // Jika ada pesan kesalahan, kembalikan ke halaman sebelumnya dengan pesan kesalahan
        if (count($messages) > 0) {
            return back()->withErrors($messages);
        }

        // Jika validasi berhasil, lanjutkan untuk mereset password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(1),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('auth.index')->with('pesan', ['type' => 'success', 'message' => 'Password berhasil direset. Silakan login.'])
            : back()->with('pesan', ['type' => 'danger', 'message' => 'Reset Password Gagal. Silakan coba lagi.']);
    }
}
