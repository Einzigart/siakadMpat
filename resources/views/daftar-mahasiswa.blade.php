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
            <h3>{{session("nama")}}</h3>
        </div>
        <div class="menu">
          @if(session("role_id") == 1)
          <a href='{{url('site/daftar-mk-tayang')}}'><h3>Daftar MK Tayang</h3></a>
          <a href='{{url('site/daftar-mahasiswa')}}'><h3>Daftar Mahasiswa</h3></a>
          <a href='{{url('site/daftar-dosen')}}'><h3>Daftar Dosen</h3></a>
          <a href='{{url('site/input-nilai-mahasiswa')}}'><h3>Input Nilai Mahasiswa</h3></a>
          @endif

          @if(session("role_id") == 2)
          <a href='{{url('site/daftar-mk-tayang')}}'><h3>Daftar MK Tayang</h3></a>
          <a href='{{url('site/daftar-dosen')}}'><h3>Daftar Dosen</h3></a>
          <a href='{{url('site/input-nilai-mahasiswa')}}'><h3>Input Nilai Mahasiswa</h3></a>
          @endif

          @if(session("role_id")  == 3)
          <a href='{{url('site/daftar-mk-tayang')}}'><h3>Daftar MK Tayang</h3></a>
          <a href='{{url('site/daftar-dosen')}}'><h3>Daftar Dosen</h3></a>
          <a href='{{url('site/lihat-nilai',[session('nim_nip')])}}'><h3>Lihat Nilai</h3></a>
          <a href='{{url('site/ambil-mk',[session('nim_nip')])}}'><h3>Ambil MK</h3></a>
          @endif
        </div>
        <div class="foot">
          <a href="{{url('logout')}}"><h1>Logout</h1></a>
        </div>
    </nav>
    <main>
     <h1>Daftar Mata Kuliah</h1>
          @if (session('role_id') == 1)
          <div class="btn_show_container">
               <button class="btn_show" onclick="show()">Tambah Dosen</button>
          </div>
          <form class="form-admin hidden " id="form-tambah-mahasiswa" action="" method="POST">
               <label for="nip">NIP</label>
               <input type="text" name="nip" required />
               <label for="nama">Nama</label>
               <input type="text" name="nama" required />
               <button type="submit"name="tambah-dosen">Tambah</button>
          </form>
          @endif
        <table>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>NAMA</th>
                <th>ANGKATAN</th>
                @if (session("role_id") == 1)
                         <th>Aksi</th>
                @endif
            </tr>
            @foreach ($mahasiswa as $m)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <th>{{ $m['nim'] }}</th>
                    <th>{{ $m['nama'] }}</th>
                    <th>{{ $m['angkatan'] }}</th>
                    @if (session("role_id") == 1)
                         <td>
                              <a class="edit" href="./admin-mahasiswa-edit.php?nim= ?>">Edit</a> |
                              <a class="delete" href="../function/admin/admin-mahasiswa-del.php?nim=" onclick="return confirm('Anda yakin untuk menghapus Mahasiswa?')">Del</a>
                         </td>
                    @endif
                </tr>
            @endforeach
        </table>
    </main>
    <script>
          function show() {
               const form = document.getElementById("form-tambah-mahasiswa");
               form.classList.toggle("hidden");
          }
     </script>
</body>

</html>
