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
               <img src="{{ asset('assets/images/user.svg') }}" width="20px" heigh="20px"/>
               <h3>nama</h3>
          </div>
          <div class="menu">
                    <a href='./daftar-mk-tayang'><h3>Daftar MK Tayang</h3></a>
                    <a href='./daftar-mahasiswa'><h3>Daftar Mahasiswa</h3></a>
                    <a href='./daftar-dosen'><h3>Daftar Dosen</h3></a>
          </div>
          <div class="foot">
               <a href="../function/logout.php"><h1>Logout</h1></a>
          </div>      
     </nav>
     <main>
          <table>
               <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>NAMA</th>
                    <th>ANGKATAN</th>
               </tr>
               @foreach ($mahasiswa as $m)
               <tr>
                    <th>{{ $loop->iteration }}</th>
                    <th>{{ $m['nim'] }}</th>
                    <th>{{ $m['nama'] }}</th>
                    <th>{{ $m['angkatan'] }}</th>
               </tr>
               @endforeach
          </table>
     </main>   
</body>
</html>