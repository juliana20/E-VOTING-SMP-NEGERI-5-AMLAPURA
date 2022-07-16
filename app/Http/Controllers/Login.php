<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Admin_m;
use Illuminate\Support\Facades\Hash;
use Session;

class Login extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        return view('auth.login');
    }

    public function auth(Request $request){
        $username   = $request->username;
        $password   = $request->password;
        $data       = Admin_m::where('username', $username)->first();
        if($data){ //apakah username tersebut ada atau tidak
            if(Hash::check($password, $data->password) AND ($data->username == $username)){
                Session::put('username', $data->username);
                Session::put('id', $data->id);
                Session::put('nama', $data->nama_admin);
                Session::put('jabatan', $data->jabatan);
                Session::put('login',TRUE);

                alert()->success('Success', 'Login Berhasil!');
                return redirect('/admin');                  
            }   
            else{
                alert()->error('Login gagal, Silahkan cek username, password atau jabatan anda!', 'Perhatian!')->persistent('Tutup');
                return redirect('login');
            }
        }
        else{
             alert()->error('Login gagal, Silahkan cek username, password atau jabatan anda!', 'Perhatian!')->persistent('Tutup');
            return redirect('login');
        }
    }
    public function logout(){
        Session::flush();
        alert()->success('Logout berhasil!', 'Sukses!');
        return redirect('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

}
