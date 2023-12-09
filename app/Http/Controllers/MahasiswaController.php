<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;


class MahasiswaController extends Controller
{
    //
    function show()
    {
        $results = Mahasiswa::query()->orderBy('nim', 'asc')->get();
        return view('daftar-mahasiswa', ["mahasiswa" => $results]);
    }

    function tambah(Request $req)
    {
        $nim = $req->input('nim');
        $nama = $req->input('nama');
        $check = DB::table('mahasiswa')
            ->select('*')
            ->where(['nim' => $nim, 'nama' => $nama])
            ->get();

        if (!(count($check) > 0)) {
            DB::table('mahasiswa')->insert([
                ['nim' => $nim, 'nama' => $nama, 'angkatan' => '2021', 'role_id' => '3'],
            ]);
            return  redirect()->back()->with('status', 'Mahasiswa ditambahkan');
        }

        return redirect()->back()->with('statusFailed', 'Mahasiswa sudah ada');
    }

    function update(Request $req)
    {
        $id = $req->input('id');
        $nama = $req->input('nama');

        DB::table('mahasiswa')
            ->where(['id' => $id])
            ->update(['nama'=>$nama]);

        return redirect()->back()->with('status', 'Data Berhasil diupdate');
    }

    function delete($nim)
    {
        DB::table('mahasiswa')
            ->where(['nim' => $nim])
            ->delete();

        return redirect()->back()->with('status', 'Mahasiswa dihapus');
    }

    function editShow($nim)
    {
        $mahasiswa = DB::table('mahasiswa')
            ->select('*')
            ->where(['nim' => $nim])
            ->get();
        return view('admin-mahasiswa-edit', ["id" => $mahasiswa[0]->id, "nim" => $mahasiswa[0]->nim, "nama" => $mahasiswa[0]->nama]);
    }
}
