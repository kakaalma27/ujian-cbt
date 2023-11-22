<?php

namespace App\Http\Controllers;
use App\Models\Soal;
use App\Models\User;
use App\Models\kelas;
use App\Models\jawaban;

use App\Models\Pelajaran;

use Illuminate\Http\Request;
use App\Models\users_jawaban;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersJawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
    }

    public function cek(Request $request)
    {
        $data = new users_jawaban();
        $data->kode_akses = $request->input('kode_akses');
        $cek = Pelajaran::where('kode_akses', $data->kode_akses)->get();
        if ($cek->isNotEmpty()) {
            $infoUjian = kelas::with('user')->get();
            $infoSoal = Soal::with('user')->count();
            $soal = Soal::with('jawabans')->paginate(1);
            return view('siswa.ujian.index', compact('infoUjian', 'cek', 'infoSoal', 'soal'));
        } else {
            return view('siswa.index');
        }
    }
    
    

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $hasil = $request->input('detail_soal');
            $soal_ids = Soal::pluck('id')->toArray();
            $user = auth()->id();
    
            foreach ($soal_ids as $soal_id) {
                $jawaban = jawaban::where('isi_jawaban', $hasil)
                    ->where('soal_id', $soal_id)
                    ->first();
    
                $user_jawaban = new users_jawaban;
                $user_jawaban->user_id = $user;
                $user_jawaban->soal_id = $soal_id;
    
                if ($jawaban->is_correct == 1) {
                    $user_jawaban->jawaban_id = $jawaban->id;
                    $user_jawaban->detail_soal = $hasil;
                    $user_jawaban->detail_jawaban = 1;
                } else {
                    $user_jawaban->jawaban_id = $jawaban->id;
                    $user_jawaban->detail_soal = $hasil;
                    $user_jawaban->detail_jawaban = 0;
                }
    
                $user_jawaban->save();
            }
    
            DB::commit(); // Commit the transaction after the loop
    
            return response()->json(true);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response('Error: ' . $e->getMessage(), 500);
        }
    }

}
