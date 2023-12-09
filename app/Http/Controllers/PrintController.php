<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PrintController extends Controller
{
    //
    function printNilaiMhs($nim)
    {
        $nilai = DB::table('matkul_diambil')
            ->join('matkul', 'matkul_diambil.kode_mk', '=', 'matkul.kode_mk')
            ->select('matkul_diambil.kode_mk', 'matkul_diambil.nilai_mk', 'matkul.nama_mk')
            ->where(['matkul_diambil.nim_mhs' => $nim])
            ->get();

        $mhs = DB::table('mahasiswa')
        ->select('nim','nama')
        ->where(['nim' => $nim])
        ->get();
        $pdf = PDF::loadview('mahasiswa-nilai-pdf',["nilai" => $nilai,"nim"=> $mhs[0]->nim,"nama"=> $mhs[0]->nama]);
        return $pdf->stream();
    }
}
