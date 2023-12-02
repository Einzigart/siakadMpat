<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body>
     <form action="{{ url('/site') }}" method="POST">
          @csrf 
          <h2>Login</h2>
          <input type="text" name ="username" required placeholder="Username">
          <input type="password" name ="password" required placeholder="Password">
          <a href="../register">Buat akun baru</a>
          <button type="submit" name ="login"> Login</button>
     </form>

</body>
</html>