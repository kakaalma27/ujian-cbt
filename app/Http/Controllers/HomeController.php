<?php

namespace App\Http\Controllers;

use App\Models\jawaban;
use Illuminate\Http\Request;
use App\Models\Pelajaran;
use App\Models\users_jawaban;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userHome(Request $request)
    {
        return view('siswa.index',["msg"=>"Hello! I am user"]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function guruHome()
    {
        return view('guru.home',["msg"=>"Hello! I am guru"]);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('admin.home',["msg"=>"Hello! I am admin"]);
    }
}