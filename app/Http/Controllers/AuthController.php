<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login(Request $req)
    {
        $username = $req->input('username');
        $password = $req->input('password');
        $check = DB::table('user')->where(['username' => $username])->get();

        if (count($check) > 0) {
            if (password_verify($password, $check[0]->password)) {
                $users = DB::table('user')->where(['username' => $username])->get();
                session(["role_id" => $users[0]->role_id]);
                session(["nim_nip" => $users[0]->nim_nip]);

                switch($users[0]->role_id){
                    case 1 :
                        $user = DB::table('admin')->where(['nip' => $users[0]->nim_nip])->get();
                        session(["nama" => $user[0]->nama]);
                        break;
                    case 2 :
                        $user = DB::table('dosen')->where(['nip' => $users[0]->nim_nip])->get();
                        session(["nama" => $user[0]->nama]);
                        break;
                    case 3 :
                        $user = DB::table('mahasiswa')->where(['nim' => $users[0]->nim_nip])->get();
                        session(["nama" => $user[0]->nama]);
                        break;
                }
                
                return view('dashboard',['user_name' => $user[0]->nama]);
            } else {
                return view('login');
            }
        } else {
            return redirect('/');
        }
    }

   function logout()
    {
        session()->forget('nama');
        session()->forget('role_id');
        session()->forget('nim_nip');
        return redirect('/');
    }

    function register()
    {
    }

}
