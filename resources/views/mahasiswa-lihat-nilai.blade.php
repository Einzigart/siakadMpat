<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
</head>

<body>
    <nav>
        <div class="userInfo">
            <img src="{{ asset('assets/images/user.svg') }}" width="20px" heigh="20px" />
            <h3>{{ session('nama') }}</h3>
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
            <a href="{{ url('logout') }}">
                <h1>Logout</h1>
            </a>
        </div>
    </nav>
    <main>
        <h1>Nilai</h1>
        <div class="container-print">
            <a class="print-btn" href="{{ url('site/lihat-nilai/nilai_pdf', [session('nim_nip')]) }}"> Print Nilai</a>
        </div>
        <table id="daftarNilai">
            <tr>
                <th>No</th>
                <th>Kode MK</th>
                <th>Nama MK</th>
                <th>Nilai</th>
            </tr>
            @foreach ($nilai as $n)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <th>{{ $n->kode_mk }}</th>
                    <th>{{ $n->nama_mk }}</th>
                    <th>{{ $n->nilai_mk }}</th>
                </tr>
            @endforeach
        </table>
    </main>
</body>

</html>
