<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;


class MahasiswaController extends Controller
{
    //
    function show(){
        $results = Mahasiswa::all();
        return view('daftar-mahasiswa',["mahasiswa" =>$results]);
    }

    function delete(){
        
    }
}
