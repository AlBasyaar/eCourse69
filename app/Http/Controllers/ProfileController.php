<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil.
     */
    public function showProfile()
    {
        $user = Auth::user();
        
        // Cek apakah pengguna bisa mengganti nama (minimal 7 hari sejak update terakhir)
        $canUpdateName = true;
        
        // Asumsi kolom 'updated_name_at' ada di tabel 'users' untuk melacak kapan nama terakhir diubah.
        // Jika kolom ini belum ada, Anda harus menambahkannya melalui migration.
        if ($user->updated_name_at) {
            $lastUpdate = Carbon::parse($user->updated_name_at);
            if ($lastUpdate->greaterThan(now()->subDays(7))) {
                $canUpdateName = false;
            }
        }

        return view('profile.show', compact('user', 'canUpdateName'));
    }

    /**
     * Memperbarui informasi profil (Nama dan Password).
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $isGmail = str_ends_with($user->email, '@gmail.com');
        $rules = [];

        // --- VALIDASI NAMA ---
        $canUpdateName = true;
        if ($user->updated_name_at) {
            $lastUpdate = Carbon::parse($user->updated_name_at);
            if ($lastUpdate->greaterThan(now()->subDays(7))) {
                $canUpdateName = false;
            }
        }

        if ($request->filled('name') && $request->name !== $user->name) {
            if (!$canUpdateName) {
                return redirect()->back()->with('error', 'Anda hanya dapat mengganti nama minimal seminggu sekali.');
            }
            $rules['name'] = ['required', 'string', 'max:255'];
        }

        // --- VALIDASI PASSWORD ---
        if ($request->filled('current_password') || $request->filled('new_password')) {
            $rules['current_password'] = ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Password saat ini salah.');
                }
            }];
            $rules['new_password'] = ['required', 'string', 'min:8', 'confirmed'];
        }
        
        $request->validate($rules);

        // --- PROSES UPDATE NAMA ---
        if ($request->filled('name') && $request->name !== $user->name && $canUpdateName) {
            $user->name = $request->name;
            // Update timestamp nama
            $user->updated_name_at = now(); 
            $user->save();
        }

        // --- PROSES UPDATE PASSWORD ---
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
            $user->save();
        }
        
        // Cek apakah ada perubahan yang disimpan
        if ($request->filled('name') || $request->filled('new_password')) {
            return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
        }
        
        return redirect()->route('profile.show');
    }
}
