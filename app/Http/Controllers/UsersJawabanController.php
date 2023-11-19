<?php

namespace App\Http\Controllers;
use App\Models\Soal;
use App\Models\jawaban;
use App\Models\User;

use Illuminate\Support\Facades\DB;

use App\Models\users_jawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersJawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $matchingRecords = Soal::join('jawabans', 'soals.id', '=', 'jawabans.soal_id')
            ->select('soals.id', 'soals.isi_soal', 'jawabans.isi_jawaban')
            ->get();
        $data = [];
        if ($matchingRecords->count() > 0) {
            foreach ($matchingRecords as $record) {
                $isiSoal = $record->isi_soal;
                $isiJawaban = $record->isi_jawaban;
                if (!isset($data[$isiSoal])) {
                    $data[$isiSoal] = [];
                }
                $data[$isiSoal][] = $isiJawaban;
            }
            
            return view('guru.demo', compact('data'));    
        } else {
            echo "Data tidak ada";
        }
    }
        

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
    
    
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\users_jawaban  $users_jawaban
     * @return \Illuminate\Http\Response
     */
    public function show(users_jawaban $users_jawaban)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\users_jawaban  $users_jawaban
     * @return \Illuminate\Http\Response
     */
    public function edit(users_jawaban $users_jawaban)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\users_jawaban  $users_jawaban
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, users_jawaban $users_jawaban)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\users_jawaban  $users_jawaban
     * @return \Illuminate\Http\Response
     */
    public function destroy(users_jawaban $users_jawaban)
    {
        //
    }
}
