<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\pelajaran;
use Illuminate\Http\Request;

class PelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pelajarans = Pelajaran::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 1);
            })
            ->get();
    
        return view('admin.crud_guru.index', compact('pelajarans'));
    }
    
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', 1)->pluck('name', 'id');
        return view('admin.crud_guru.create', compact('users'));
    }
    

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'pelajaran' => 'required',
            'kode_akses' => 'nullable',
        ]);
        
    
        Pelajaran::create($data); // Debug the result of the create operation
        return redirect()->route('pelajaran.index')->with('success', 'Account berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pelajaran  $pelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(pelajaran $pelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pelajaran  $pelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(pelajaran $pelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pelajaran  $pelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pelajaran $pelajaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pelajaran  $pelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(pelajaran $pelajaran)
    {
        //
    }
}
