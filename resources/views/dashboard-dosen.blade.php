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
                    <a href='./daftar-mk-tayang.php'><h3>Daftar MK Tayang</h3></a>
                    <a href='./daftar-dosen.php'><h3>Daftar Dosen</h3></a>
                    <a href='./input-nilai.php'><h3>Input Nilai Mahasiswa</h3></a>
          </div>
          <div class="foot">
               <a href="../function/logout.php"><h1>Logout</h1></a>
          </div>      
     </nav>
     <main>
          <div class="dashboard">
               <h1>Selamat Datang <br/>{{ $user_name}}</h1>
          </div>
     </main>   
</body>
</html>