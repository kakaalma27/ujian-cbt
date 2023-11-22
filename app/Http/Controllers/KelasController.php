<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\kelas;
use App\Models\usersKelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::all();
        $jumlahSiswa = [];
    
        foreach ($kelas as $kelasItem) {
            if ($kelasItem instanceof Kelas) {
                $kelasId = $kelasItem->id;
                $jumlahSiswa[$kelasId] = usersKelas::where('kelas_id', $kelasId)->count('user_id');
            } else {
                // Handle the case where $kelasItem is not an instance of Kelas
                echo "Invalid data type for Kelas";
            }
        }
        $siswa = usersKelas::with('kelas', 'user')
        ->whereHas('kelas', function ($query) {
            $query->whereColumn('kelas_id', 'kelas.id');
        })
        ->whereHas('user', function ($query) {
            $query->whereColumn('user_id', 'users.id');
        })
        ->get();
        
        return view('admin.crud_kelas.index', compact('kelas', 'jumlahSiswa', 'siswa'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.crud_kelas.create');
    }

    public function store(Request $request)
    {
        $data = new kelas;
        $data->user_id = auth()->id();
        $data->nama_kelas = $request->input('nama_kelas');
        $data->save();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kelas $kelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(kelas $kelas)
    {
        //
    }
}
