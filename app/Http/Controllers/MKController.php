<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class MKController extends Controller
{

    function show(){
        $matkul = DB::table('matkul')
        ->join('dosen', 'matkul.NIP_pengampu', '=', 'dosen.nip')
        ->select('matkul.kode_mk', 'matkul.nama_mk', 'matkul.semester','dosen.nama')
        ->get();
        return view('daftar-mk-tayang',["matkul" =>$matkul]);
    }

    function getNilaiMK($nim_nip){
        $nilai = DB::table('matkul_diambil')
        ->join('matkul', 'matkul_diambil.kode_mk', '=', 'matkul.kode_mk')
        ->select('matkul_diambil.kode_mk', 'matkul_diambil.nilai_mk','matkul.nama_mk')
        ->where(['matkul_diambil.nim_mhs' => $nim_nip])
        ->get();
        return view('mahasiswa-lihat-nilai',["nilai" =>$nilai]);
    }

    function listAmbilMK($nim_nip){
        $mkd = DB::table('matkul_diambil')
        ->join('matkul', 'matkul_diambil.kode_mk', '=', 'matkul.kode_mk')
        ->join('dosen', 'matkul.NIP_pengampu', '=', 'dosen.nip')
        ->select('matkul_diambil.*', 'dosen.*','matkul.*')
        ->where(['matkul_diambil.nim_mhs' => $nim_nip])
        ->get();

        $mkt = DB::table('matkul')
        ->select('matkul.kode_mk', 'matkul.nama_mk')
        ->get();

        return view('mahasiswa-ambil-mk',["matkul_diambil" =>$mkd , "mk_tayang" =>$mkt]);
    }

    function tambahMK(Request $req ){
        $kode_mk = $req->input('mk-diambil');
        $check=DB::table('matkul_diambil')
        ->select('*')
        ->where(['nim_mhs' => session('nim_nip') ,'kode_mk' =>$kode_mk])
        ->get();

        if(!(count($check) > 0)){
            DB::table('matkul_diambil')->insert([
                ['nim_mhs' => session('nim_nip'), 'kode_mk' => $kode_mk ,'nilai_mk'=> '0'],
            ]);
        }
        return  redirect()->back()->with('status', 'Matakuliah ditambahkan');
    }


    function deleteMK($nim_nip , $kode_mk){
         DB::table('matkul_diambil')
        ->where(['nim_mhs' => $nim_nip ,'kode_mk' =>$kode_mk])
        ->delete();
 
        return redirect()->back()->with('status', 'Matakuliah dihapus');
    }
}
