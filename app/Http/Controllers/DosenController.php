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

    function saveInputNilai(Request $request, $kode_mk)
    {
        $nilai = $request->input('nilaimk');
        $mhs = $request ->input('nimmhs');

        for($i= 0 ; $i < count($mhs); $i++){
            DB::table('matkul_diambil')
            ->where(['nim_mhs'=> $mhs[$i],'kode_mk' => $kode_mk])
            ->update(['nilai_mk' => $nilai[$i]]);
        }
        return redirect()->back()->with('status','Data Berhasil disimpan');

    }

    function tambah(Request $req)
    {
        $nip = $req->input('nip');
        $nama = $req->input('nama');
        $check = DB::table('dosen')
            ->select('*')
            ->where(['nip' => $nip, 'nama' => $nama])
            ->get();

        if (!(count($check) > 0)) {
            DB::table('dosen')->insert([
                ['nip' => $nip, 'nama' => $nama,'role_id' => '2'],
            ]);
            return  redirect()->back()->with('status', 'Dosen ditambahkan');
        }
        return redirect()->back()->with('statusFailed', 'Dosen sudah ada');
    }

    function update(Request $req)
    {
        $id = $req->input('id');
        $nama = $req->input('nama');

        DB::table('dosen')
            ->where(['id' => $id])
            ->update(['nama'=>$nama]);

        return redirect()->back()->with('status', 'Dosen Berhasil diupdate');
    }

    function delete($nip)
    {
        DB::table('dosen')
            ->where(['nip' => $nip])
            ->delete();
        return redirect()->back()->with('status', 'Dosen dihapus');
    }

    function editShow($nip)
    {
        $dosen = DB::table('dosen')
            ->select('*')
            ->where(['nip' => $nip])
            ->get();
        return view('admin-dosen-edit', ["id" => $dosen[0]->id, "nip" => $dosen[0]->nip, "nama" => $dosen[0]->nama]);
    }
}
