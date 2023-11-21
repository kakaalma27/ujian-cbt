<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\User;
use App\Models\users_kelas;
use Illuminate\Http\Request;
use App\Models\pelajaran;

class CrudAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $selectedRole = $request->input('listRole');
        $query = User::query();
        
        if ($selectedRole !== null) {
            $query->where('role', $selectedRole);
        }

        if($selectedRole == 0){
            $accounts = users_kelas::with(['kelas', 'user'])
                ->when($selectedRole, function ($query) use ($selectedRole) {
                    $query->whereHas('user', function ($userQuery) use ($selectedRole) {
                        $userQuery->where('role', $selectedRole);
                    });
                })
                ->get();
            
            return view('admin.crud_admin.index', compact('accounts', 'selectedRole'));
        }else{
            $accounts = $query->get();
            return view('admin.crud_admin.index', compact('accounts', 'selectedRole'));
        }
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
    

// Assuming $request->input('id') contains the kelas_id

// Retrieve the corresponding nama_kelas
$namaKelas = Kelas::where('id', $request->input('id'))->value('nama_kelas');

// Create a new users_kelas instance
$data = new users_kelas();
$data->kelas_id = $request->input('id');
$data->user_id = $user->id;
$data->nama = $request->input('name');
$data->nama_kelas = $namaKelas; // Assign the retrieved nama_kelas
$data->save();

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
