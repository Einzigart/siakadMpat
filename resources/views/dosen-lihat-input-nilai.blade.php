<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel ="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
</head>

<body>
    <nav>
          <div class="header">
            <!-- Logo and UNS text -->
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="40px" height="40px" />
            <h3>Universitas Sebelas Maret</h3>
        </div>
        
        <div class="menu">
            @if (session('role_id') == 1)
                <a href='{{ url('site/daftar-mk-tayang') }}'>
                    <h3>Daftar MK Tayang</h3>
                </a>
                <a href='{{ url('site/daftar-mahasiswa') }}'>
                    <h3>Daftar Mahasiswa</h3>
                </a>
                <a href='{{ url('site/daftar-dosen') }}'>
                    <h3>Daftar Dosen</h3>
                </a>
                <a href='{{ url('site/input-nilai-mahasiswa') }}'>
                    <h3>Input Nilai Mahasiswa</h3>
                </a>
            @endif

            @if (session('role_id') == 2)
                <a href='{{ url('site/daftar-mk-tayang') }}'>
                    <h3>Daftar MK Tayang</h3>
                </a>
                <a href='{{ url('site/daftar-dosen') }}'>
                    <h3>Daftar Dosen</h3>
                </a>
                <a href='{{ url('site/input-nilai-mahasiswa') }}'>
                    <h3>Input Nilai Mahasiswa</h3>
                </a>
            @endif

            @if (session('role_id') == 3)
                <a href='{{ url('site/daftar-mk-tayang') }}'>
                    <h3>Daftar MK Tayang</h3>
                </a>
                <a href='{{ url('site/daftar-dosen') }}'>
                    <h3>Daftar Dosen</h3>
                </a>
                <a href='{{ url('site/lihat-nilai', [session('nim_nip')]) }}'>
                    <h3>Lihat Nilai</h3>
                </a>
                <a href='{{ url('site/ambil-mk', [session('nim_nip')]) }}'>
                    <h3>Ambil MK</h3>
                </a>
            @endif

        </div>

          <div class="foot">
               <div class="userInfo">
                    <img src="{{ asset('assets/images/user.svg') }}" width="20px" heigh="20px"/>
                    <h3>{{session("nama")}}</h3>
               </div>
               <!-- Logout with an icon -->
               <a href="{{ url('logout') }}"><img src="{{ asset('assets/images/logout-icon.png') }}" alt="Logout" width="20px" height="20px" /></a>
          </div>     
    </nav>

    <main>
        <h1>{{ $kode_mk }}</h1>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <table>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Nilai</th>
            </tr>
            <form action="{{ url('site/lihat-input-nilai', [$kode_mk]) }}" method="POST">
                @csrf
                @foreach ($mahasiswa as $mhs)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <th>{{ $mhs->nim }}</th>
                        <th>{{ $mhs->nama }}</th>
                        <td>
                            <input type="hidden" name="nimmhs[]" value="{{ $mhs->nim_mhs }}" />
                            <input style="text-align:center" type='number' name="nilaimk[]"
                                value="{{ $mhs->nilai_mk }}" min=0 max=4></input>
                        </td>
                    </tr>
                @endforeach
                <button type="submit" class="btn_show print-btn" name="simpan-nilai">Simpan</button>
            </form>
        </table>
    </main>
</body>

</html>
