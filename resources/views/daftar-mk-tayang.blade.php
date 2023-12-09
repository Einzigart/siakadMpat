<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel ="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
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
            <a href="{{ url('logout') }}">
                <h1>Logout</h1>
            </a>
        </div>
    </nav>
    <main>
        <h1>Daftar Mata Kuliah</h1>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('statusFailed'))
            <div class="alert alert-failed">
                {{ session('statusFailed') }}
            </div>
        @endif
        @if (session('role_id') == 1)
            <div class="btn_show_container">
                <button class="btn_show" onclick="show()">Tambah MK</button>
            </div>
            <form class="form-admin hidden" id="form-tambah-mk" action="{{url('site/daftar-mk-tayang/tambah')}}" method="POST">
                @csrf
                <label for="kode_mk">Kode_MK</label>
                <input type="text" name="kode_mk" required />
                <label for="nama_mk">Nama MK</label>
                <input type="text" name="nama_mk" required />
                <label for="pengampu">Pengampu</label>
                <select name="pengampu" required>
                    @foreach($dosen as $dsn)
                    <option value= {{ $dsn->nip }}>{{ $dsn->nama }} ( {{ $dsn->nip }} )</option>
                    @endforeach
                </select>
                <button type="submit"name="tambah-mk">Simpan</button>
            </form>
        @endif

        <table>
            <tr>
                <th>No</th>
                <th>Kode MK</th>
                <th>Nama MK</th>
                <th>Semester</th>
                <th>Pengampu</th>
                @if (session('role_id') == 1)
                    <th>Aksi</th>
                @endif
            </tr>
            @foreach ($matkul as $mk)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <th>{{ $mk->kode_mk }}</th>
                    <th>{{ $mk->nama_mk }}</th>
                    <th>{{ $mk->semester }}</th>
                    <th>{{ $mk->nama }}</th>
                    @if (session('role_id') == 1)
                        <td>
                            <a class="edit" href="{{url('site/daftar-mk-tayang/update',[$mk->id])}}">Edit</a> |
                            <a class="delete" href="{{url('/site/daftar-mk-tayang/delete',[$mk->kode_mk])}}" 
                                onclick = "return confirm('Anda yakin untuk menghapus Mata Kuliah?')">Del</a>
                        </td>
                    @endif
                </tr>
            @endforeach

        </table>
    </main>
    <script>
        function show() {
            const form = document.getElementById("form-tambah-mk");
            form.classList.toggle("hidden");
        }
    </script>
</body>

</html>
