<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;


class MahasiswaController extends Controller
{
    //
    function show(){
        $results = Mahasiswa::query()->orderBy('nim','asc')->get();
        return view('daftar-mahasiswa',["mahasiswa" =>$results]);
    }

}
