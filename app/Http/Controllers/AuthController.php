<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Menangani proses login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Redirect berdasarkan peran pengguna
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect()->intended('/admin/dashboard');
                case 'mentor':
                    return redirect()->intended('/mentor/dashboard');
                case 'student':
                    return redirect()->intended('/student/dashboard');
                default:
                    return redirect()->intended('/home');
            }
        }

        throw ValidationException::withMessages([
            'email' => ['Kredensial yang diberikan tidak cocok dengan catatan kami.'],
        ]);
    }

    /**
     * Menampilkan form registrasi.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Menangani proses registrasi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
public function register(Request $request)
    {
        // 1. Ambil kode verifikasi statis dari .env
        $verificationCode = env('VERIFICATION_CODE'); // Akan mengambil string atau null

        // 2. Aturan validasi dasar
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];

        // 3. Tambahkan validasi untuk kode verifikasi hanya jika VERIFICATION_CODE ada di .env
        if (!empty($verificationCode)) {
            $rules['verification_code'] = 'required|string';
        }

        $request->validate($rules);

        // 4. Lakukan pengecekan kode verifikasi secara manual (HARUS ADA SEBELUM USER DIBUAT)
        if (!empty($verificationCode) && $request->verification_code !== $verificationCode) {
            // Jika kode verifikasi tidak cocok, lempar error validasi
            throw ValidationException::withMessages([
                'verification_code' => ['Kode verifikasi yang diberikan salah.'],
            ]);
        }
        
        // 5. Buat user baru dengan peran (role) otomatis 'student'
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student', // Peran disetel otomatis menjadi 'student'
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Menangani proses logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function submitForgotPasswordRequest(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'email.exists' => 'Alamat email ini tidak terdaftar.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        // Ambil user yang mengajukan permintaan
        $user = User::where('email', $request->email)->first();

        // 1. Simpan password baru yang diminta (sudah di-hash)
        // Admin yang akan mengaplikasikannya di panel admin
        $user->requested_password = Hash::make($request->new_password);
        
        // 2. Set status permintaan menjadi 'pending'
        $user->password_reset_status = 'pending';
        
        // 3. Reset token dan masa berlaku (optional, jika Anda ingin token reset via email)
        $user->password_reset_token = \Illuminate\Support\Str::random(60); 
        $user->password_reset_expires_at = now()->addHours(24);
        
        $user->save();

        // Note: Dalam aplikasi nyata, di sini akan ada pengiriman email notifikasi ke Admin
        // agar Admin tahu ada permintaan yang perlu ditinjau.
        
        return redirect()->route('login')->with('success', 'Permintaan ganti password telah diajukan. Kami akan meninjau dan memberitahu Anda.');
    }
}
