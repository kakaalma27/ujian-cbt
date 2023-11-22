<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\User;

use App\Models\usersKelas;
use Illuminate\Http\Request;

class UsersKelasController extends Controller
{
    public function create()
    {
        $kelas = Kelas::all();
        $value = 0;
        $users = User::where('role', $value)->get();
    
        // Mendapatkan opsi yang sudah terpilih dari sesi
        $selectedUserIds = session('selectedUserIds', []);
    
        return view('admin.crud_kelas.crud_anggota.create', compact('kelas', 'users', 'selectedUserIds'));
    }
    public function upload(Request $request)
    {
        try {
            $request->validate([
                'kelas_id' => 'required',
                'user_ids' => 'required|array',
            ]);
    
            $kelas_id = $request->kelas_id;
            $user_ids = $request->user_ids;
    
            foreach ($user_ids as $user_id) {
                // Pengecekan apakah user_id sudah memiliki kelas
                $existingRecord = UsersKelas::where('user_id', $user_id)->first();
    
                if ($existingRecord) {
                    // Jika sudah memiliki kelas, tampilkan pesan kesalahan dan kembali ke halaman sebelumnya
                    return redirect()->back()->with('error', 'User already assigned to a class.');
                }
    
                // Buat record baru
                $anggota = new UsersKelas();
                $anggota->kelas_id = $kelas_id;
                $anggota->user_id = $user_id;
    
                // Mengambil nama pengguna dari model User
                $user = User::find($user_id);
                $anggota->nama = $user->name;
    
                $anggota->save();
            }
    
            return redirect()->route('kelas.index');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan lain, tampilkan pesan kesalahan
            return redirect()->back()->with('error', 'An error occurred during the upload process.');
        }
    }
    
    
    
    
    
    
    
}
