<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body>
     <form action={{ url('/register') }} method="POST">
          <label for ="nim"> NIM</label>
          <input type="text" name ="nim" required>
          <label for ="username"> Username</label>
          <input type="text" name ="username" required>
          <label for ="password"> Password</label>
          <input type="password" name ="password" required>
          <label for ="copassword">Co-Password</label>
          <input type="password" name ="copassword" required>
          <a href="../">Sudah punya akun?</a>
          <button type="submit" name ="register"> Daftar</button>
     </form>

</body>

</html>