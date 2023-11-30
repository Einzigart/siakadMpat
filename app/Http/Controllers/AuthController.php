<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;  

use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login(Request $req){

        $username = $req->input('username');
        $password = $req->input('password');

        $check = DB::table('user')->where(['username'=>$username])->get();

        // $users = DB::select('select * from user where username = ');

        if(count($check) > 0){
            if(password_verify($password,$check[0]->password)){
                $users= DB::table('user')->where(['username'=>$username])->get();
                switch($users[0]->role_id){
                    case 1 :
                        return view('dashboard-admin',['user_name'=> $users[0]->nim_nip]);
                        break;
                    case 2 :
                        return view('dashboard-dosen',['user_name'=> $users[0]->nim_nip]);
                        break;
                    case 3 :
                        return view('dashboard-mahasiswa',['user_name'=> $users[0]->nim_nip]);
                        break;
                }
               
           }else{
            return view('login');
           }
        }else{
            return redirect('/');
        }
        
    
    }

    function register(){

    }
    //
}
