<?php
require '../function/connect.php';
session_start();

if (!isset($_SESSION["login"])) {
     header("Location: ./login.php");
     exit();
}


if (isset($_POST["edit-dosen"])) {
     $dosen_id = $_POST["dosen_id"];
     $nip = $_POST["nip"];
     $nama = $_POST["nama"];

     // $sqlDosenUpdate = "UPDATE dosen INNER JOIN matkul ON dosen.nip=matkul.NIP_pengampu SET nip='".$nip."',nama='".$nama."', 
     // matkul.NIP_pengampu='".$nip."' WHERE `dosen.id`='".$dosen_id."'";
     $sqlDosenUpdate = "UPDATE dosen INNER JOIN matkul ON dosen.nip = matkul.NIP_pengampu SET nip = '".$nip."', nama='".$nama."', matkul.NIP_pengampu ='".$nip."' WHERE dosen.id ='".$dosen_id."'";

     $conn->query($sqlDosenUpdate);
     unset($_POST);
     header("Location: ./daftar-dosen.php");
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
          <h1>Edit Dosen</h1>
          
          <?php if ($_SESSION["role"] == 1) : ?>
               <?php 
                    $editDosen = $_GET["nip"];
                    $sqlget = "SELECT * FROM dosen WHERE nip='".$editDosen."'" ;
                    $getDosen = $conn->query($sqlget);
                    if(mysqli_num_rows($getDosen)===1){
                         $row = mysqli_fetch_assoc($getDosen);
                    }
               ?>
                <form class="form-admin " id="form-edit-dosen" action="" method="POST" >
                    <input type="hidden"  name="dosen_id" value="<?= $row["id"]?>"/>
                    <label for="nip">NIP</label>
                    <input type="text" name="nip" required value="<?= $row["nip"]?>"/>
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" required value="<?= $row["nama"]?>"/>
                    <button type="submit"name="edit-dosen">Simpan</button>
               </form>
          <?php endif ?>
         
     </main>
</body>

</html>