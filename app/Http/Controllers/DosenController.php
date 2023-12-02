<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    function show()
    {
        $dosen = DB::table('dosen')->orderBy("dosen.nip", 'asc')->get();
        return view('daftar-dosen', ["dosen" => $dosen]);
    }

    function showMatkul()
    {
        if (session('role_id') == 1) {
            $mkp = DB::table('matkul')->get();
            return view('dosen-input-nilai', ["matkul_diampu" => $mkp]);
        }
        $mkp = DB::table('matkul')->where(['NIP_pengampu' => session('nim_nip')])->get();
        return view('dosen-input-nilai', ["matkul_diampu" => $mkp]);
    }

    function inputNilai($kode_mk)
    {

        $mahasiswa = DB::table('matkul_diambil')
            ->join('mahasiswa', 'matkul_diambil.nim_mhs', '=', 'mahasiswa.nim')
            ->where(['kode_mk' => $kode_mk])
            ->orderBy('matkul_diambil.nim_mhs', 'asc')
            ->get();
        return view('dosen-lihat-input-nilai', ["kode_mk" => $kode_mk, "mahasiswa" => $mahasiswa]);
    }
}
