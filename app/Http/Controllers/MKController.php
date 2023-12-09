<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class MKController extends Controller
{

    function show()
    {
        $matkul = DB::table('matkul')
            ->join('dosen', 'matkul.NIP_pengampu', '=', 'dosen.nip')
            ->select('matkul.kode_mk', 'matkul.nama_mk', 'matkul.semester', 'dosen.nama', 'matkul.id')
            ->get();

        $dosen = DB::table('dosen')
            ->select('*')
            ->get();

        return view('daftar-mk-tayang', ["matkul" => $matkul, "dosen" => $dosen]);
    }

    function getNilaiMK($nim_nip)
    {
        $nilai = DB::table('matkul_diambil')
            ->join('matkul', 'matkul_diambil.kode_mk', '=', 'matkul.kode_mk')
            ->select('matkul_diambil.kode_mk', 'matkul_diambil.nilai_mk', 'matkul.nama_mk')
            ->where(['matkul_diambil.nim_mhs' => $nim_nip])
            ->get();
        return view('mahasiswa-lihat-nilai', ["nilai" => $nilai]);
    }

    function listAmbilMK($nim_nip)
    {
        $mkd = DB::table('matkul_diambil')
            ->join('matkul', 'matkul_diambil.kode_mk', '=', 'matkul.kode_mk')
            ->join('dosen', 'matkul.NIP_pengampu', '=', 'dosen.nip')
            ->select('matkul_diambil.*', 'dosen.*', 'matkul.*')
            ->where(['matkul_diambil.nim_mhs' => $nim_nip])
            ->get();

        $mkt = DB::table('matkul')
            ->select('matkul.kode_mk', 'matkul.nama_mk')
            ->get();

        return view('mahasiswa-ambil-mk', ["matkul_diambil" => $mkd, "mk_tayang" => $mkt]);
    }

    function tambahMK(Request $req)
    {
        $kode_mk = $req->input('mk-diambil');
        $check = DB::table('matkul_diambil')
            ->select('*')
            ->where(['nim_mhs' => session('nim_nip'), 'kode_mk' => $kode_mk])
            ->get();

        if (!(count($check) > 0)) {
            DB::table('matkul_diambil')->insert([
                ['nim_mhs' => session('nim_nip'), 'kode_mk' => $kode_mk, 'nilai_mk' => '0'],
            ]);
        }
        return  redirect()->back()->with('status', 'Matakuliah ditambahkan');
    }

    function deleteMK($nim_nip, $kode_mk)
    {
        DB::table('matkul_diambil')
            ->where(['nim_mhs' => $nim_nip, 'kode_mk' => $kode_mk])
            ->delete();

        return redirect()->back()->with('status', 'Matakuliah dihapus');
    }

    function tambah(Request $req)
    {
        $kode_mk = $req->input('kode_mk');
        $nama_mk = $req->input('nama_mk');
        $pengampu = $req->input('pengampu');
        $check = DB::table('matkul')
            ->select('*')
            ->where(['kode_mk' => $kode_mk])
            ->get();

        if (!(count($check) > 0)) {
            DB::table('matkul')->insert([
                ['kode_mk' => $kode_mk, 'nama_mk' => $nama_mk, 'NIP_pengampu' => $pengampu, 'semester' => '5'],
            ]);
            return  redirect()->back()->with('status', 'MK ditambahkan');
        }

        return redirect()->back()->with('statusFailed', 'MK sudah ada');
    }

    function update(Request $req)
    {
        $mk_id = $req->input('mk_id');
        $kode_mk = $req->input('kode_mk');
        $nama_mk = $req->input('nama_mk');
        $pengampu = $req->input('pengampu');

        DB::table('matkul')
            ->where(['id' => $mk_id])
            ->update(['nama_mk' => $nama_mk,'kode_mk'=>$kode_mk,'NIP_pengampu' =>$pengampu]);
            
        return redirect()->back()->with('status', 'Mata Kuliah Berhasil diupdate');
    }

    function delete($kode_mk)
    {
        DB::table('matkul')
            ->where(['kode_mk' => $kode_mk])
            ->delete();

        return redirect()->back()->with('status', 'Mata Kuliah dihapus');
    }

    function editShow($id)
    {
        $matkul = DB::table('matkul')
            ->select('*')
            ->where(['id' => $id])
            ->get();

        $dosen = DB::table('dosen')
            ->select('*')
            ->get();

        return view('admin-mk-edit', [
            "id" => $matkul[0]->id,
            "dosen" => $dosen,
            "kode_mk" => $matkul[0]->kode_mk,
            "nama_mk" => $matkul[0]->nama_mk,
            "nip_pengampu" => $matkul[0]->NIP_pengampu
        ]);
    }
}
