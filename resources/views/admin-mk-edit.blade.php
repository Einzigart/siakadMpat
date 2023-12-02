<?php
require '../function/connect.php';
session_start();

if (!isset($_SESSION["login"])) {
     header("Location: ./login.php");
     exit();
}


if (isset($_POST["edit-mk-tayang"])) {
     $mk_id = $_POST["mk_id"];
     $kode_mk = $_POST["kode_mk"];
     $nama_mk = $_POST["nama_mk"];
     $pengampu = $_POST["pengampu"];
     $sqlmkUpdate = "UPDATE `matkul` SET `kode_mk`='".$kode_mk."',`nama_mk`='".$nama_mk."',`NIP_pengampu`='".$pengampu."' WHERE id='".$mk_id."'";
     $conn->query($sqlmkUpdate);
     unset($_POST);

     header("Location: ./daftar-mk-tayang.php");
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
          <h1>Edit Mata Kuliah Tayang</h1>
          
          <?php if ($_SESSION["role"] == 1) : ?>
               <?php
               $sqlGET = "SELECT * FROM dosen";
               $res = $conn->query($sqlGET);
               ?>

               <?php 
                    $editMK = $_GET["kode_mk"];
                     $sqlget = "SELECT * FROM matkul WHERE kode_mk='".$editMK."'" ;
                     $getMK = $conn->query($sqlget);
                     if(mysqli_num_rows($getMK)===1){
                         $row = mysqli_fetch_assoc($getMK);
                    }
               ?>

               <form class="form-admin" id="form-tambah-mk" action="" method="POST">
                    <input type="hidden" name="mk_id" value="<?= $row["id"]?>"/>
                    <label for="kode_mk">Kode_MK</label>
                    <input type="text" name="kode_mk" value="<?php echo $row["kode_mk"]?>" required />
                    <label for="nama_mk">Nama MK</label>
                    <input type="text" name="nama_mk" value="<?php echo $row["nama_mk"]?>" required />
                    <label for="pengampu">Pengampu</label>
                    <select name="pengampu" required value="<?php echo $row["NIP_pengampu"]?>">
                         <?php while ($row = mysqli_fetch_assoc($res)) : ?>
                              <option value=<?= $row["nip"] ?>> <?php echo $row["nama"] . "( " . $row["nip"] . " )" ?></option>
                         <?php endwhile; ?>
                    </select>
                    <button type="submit" name="edit-mk-tayang">Simpan</button>
               </form>
          <?php endif ?>
         
     </main>
</body>

</html>