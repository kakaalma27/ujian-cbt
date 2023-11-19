<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\User;

use Illuminate\Http\Request;

class CrudAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Mendapatkan nilai yang dipilih dari elemen <select>
        $selectedRole = $request->input('listRole');
        // Mengambil data berdasarkan peran yang dipilih atau semua jika tidak ada peran yang dipilih
        $query = User::query();
        
        if ($selectedRole !== null) {
            $query->where('role', $selectedRole);
        }
        $accounts = $query->with('kelas')->get(); 
        return view('admin.crud_admin.index', compact('accounts', 'selectedRole'));
    }
    
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account = User::all();
        $kelas = kelas::all();
        return view('admin.crud_admin.create', compact('account','kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:user,editor,admin',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => array_search($request->role, ['user', 'editor', 'admin']),
        ]);
    
        // Dapatkan objek kelas berdasarkan nilai 'id_kelas' yang dipilih oleh pengguna.
        // $kelas = Kelas::find($request->id_kelas);
    
        // if ($kelas) {
        //     $user->kelas()->associate($kelas);
        //     $user->save();
        // }
        return redirect()->route('account.index')->with('success', 'Account berhasil ditambahkan.');
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CrudAccount  $crudAccount
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CrudAccount  $crudAccount
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CrudAccount  $crudAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CrudAccount  $crudAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
