<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\kelas;
use App\Models\pelajaran;
use App\Models\users_kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get the selected role from the request
        $selectedRole = $request->input('listRole');
    
        // Fetch the accounts based on the selected role
        $query = User::query();
    
        if ($selectedRole !== null) {
            $query->where('role', $selectedRole);
    
            // Include related data based on role
            if ($selectedRole == 0) {
                $query->with(['kelas' => function ($query) {
                    $query->select('id', 'nama_kelas');
                }]);
            } elseif ($selectedRole == 1) {
                $query->with(['pelajaran' => function ($query) {
                    $query->select('id', 'nama_pelajaran');
                }]);
            }
        }
    
        // Get the users with the specified role and related data
        $accounts = $query->get();
    
        // Pass the data to the view, including the selectedRole
        return view('admin.crud_admin.index', [
            'accounts' => $accounts,
            'selectedRole' => $selectedRole,
        ]);
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
        try {
            // Start a database transaction
            DB::beginTransaction();
    
            // Create a new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => array_search($request->role, ['user', 'editor', 'admin']),
            ]);
    
            // Commit the transaction if everything is successful
            DB::commit();
    
            return redirect()->route('account.index')->with('success', 'Account berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs
            DB::rollback();
    
            // Handle the error (log, display a message, etc.)
            return redirect()->route('account.index')->with('error', 'Gagal menambahkan akun.');
        }
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
