<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\User;
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
        $kelas = kelas::all();
        return view('admin.crud_kelas.index', compact('kelas'));
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

        $usersWithRole0 = User::where('role', 0)->get();

        // Validate and create a 'kelas' record for each user with 'role' 0
        foreach ($usersWithRole0 as $user) {
            $data = [
                'user_id' => $user->id,
                'nama_kelas' => $request->input('nama_kelas'),
            ];
            
            Kelas::create($data);
        }
    
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
