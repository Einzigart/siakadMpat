<?php
require '../function/connect.php';
session_start();

if (!isset($_SESSION["login"])) {
     header("Location: ./login.php");
     exit();
}


if (isset($_POST["edit-mahasiswa"])) {
     $mahasiswa_id = $_POST["mahasiswa_id"];
     $nim = $_POST["nim"];
     $nama = $_POST["nama"];
   
     $sqlMahasiswaUpdate = "UPDATE `mahasiswa`INNER JOIN matkul_diambil ON mahasiswa.nim =matkul_diambil.nim_mhs SET `nim`='".$nim."',`nama`='".$nama."', matkul_diambil.nim_mhs='".$nim."' WHERE mahasiswa.id='".$mahasiswa_id."'";
     $conn->query($sqlMahasiswaUpdate);
     unset($_POST);
     header("Location: ./daftar-mahasiswa.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>
     <nav>
          <div class="userInfo">
               <img src="../public/user.svg" width="20px" heigh="20px"/>
               <h3><?php echo $_SESSION["user-name"]?></h3>
          </div>
          <div class="menu">
               <?php if ($_SESSION['role'] == 1) : ?>
                    <a href='./daftar-mk-tayang.php'>
                         <h3>Daftar MK Tayang</h3>
                    </a>
                    <a href='./daftar-mahasiswa.php'>
                         <h3>Daftar Mahasiswa</h3>
                    </a>
                    <a href='./daftar-dosen.php'>
                         <h3>Daftar Dosen</h3>
                    </a>
               <?php endif ?>
               <?php if ($_SESSION['role'] == 2) : ?>
                    <a href='./daftar-mk-tayang.php'>
                         <h3>Daftar MK Tayang</h3>
                    </a>
                    <a href='./daftar-dosen.php'>
                         <h3>Daftar Dosen</h3>
                    </a>
                    <a href='./input-nilai.php'>
                         <h3>Input Nilai Mahasiswa</h3>
                    </a>
               <?php endif ?>
               <?php if ($_SESSION['role'] == 3) : ?>
                    <a href='./daftar-mk-tayang.php'>
                         <h3>Daftar MK Tayang</h3>
                    </a>
                    <a href='./daftar-dosen.php'>
                         <h3>Daftar Dosen</h3>
                    </a>
                    <a href='./lihat-nilai.php'>
                         <h3>Lihat Nilai</h3>
                    </a>
                    <a href='./ambil-mk.php'>
                         <h3>Ambil MK</h3>
                    </a>
               <?php endif ?>

          </div>
          <div class="foot">
               <a href="../function/logout.php">
                    <h1>Logout</h1>
               </a>
          </div>
     </nav>

     <!-- MAIN -->
     <main>
          <h1>Edit Mahasiswa</h1>
          
          <?php if ($_SESSION["role"] == 1) : ?>
               <?php 
                    $editMahasiswa = $_GET["nim"];
                    $sqlget = "SELECT * FROM mahasiswa WHERE nim='".$editMahasiswa."'" ;
                    $getMahasiswa = $conn->query($sqlget);
                    if(mysqli_num_rows($getMahasiswa)===1){
                         $row = mysqli_fetch_assoc($getMahasiswa);
                    }
               ?>
                <form class="form-admin " id="form-edit-mahasiswa" action="" method="POST" >
                    <input type="hidden" name="mahasiswa_id" value="<?= $row["id"]?>"/>
                    <label for="nim">NIM</label>
                    <input type="text" name="nim" required value="<?= $row["nim"]?>"/>
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" required value="<?= $row["nama"]?>"/>
                    <button type="submit"name="edit-mahasiswa">Simpan</button>
               </form>
          <?php endif ?>
         
     </main>
</body>

</html>