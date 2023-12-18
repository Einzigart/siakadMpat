
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel ="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
     <link rel ="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
</head>
<body>
     <nav>
          <div class="header">
            <!-- Logo and UNS text -->
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="40px" height="40px" />
            <h3>Universitas Sebelas Maret</h3>
        </div>
        
        <div class="menu">
               @if(session("role_id") == 1)
               <a href='{{url('site/daftar-mk-tayang')}}'><h3>Daftar MK Tayang</h3></a>
               <a href='{{url('site/daftar-mahasiswa')}}'><h3>Daftar Mahasiswa</h3></a>
               <a href='{{url('site/daftar-dosen')}}'><h3>Daftar Dosen</h3></a>
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
               <div class="userInfo">
                    <img src="{{ asset('assets/images/user.svg') }}" width="20px" heigh="20px"/>
                    <h3>{{session("nama")}}</h3>
               </div>
               <!-- Logout with an icon -->
               <a href="{{ url('logout') }}"><img src="{{ asset('assets/images/logout-icon.png') }}" alt="Logout" width="20px" height="20px" /></a>
          </div>     
     </nav>
     <main>
          <h1>Ambil MK</h1>
          @if (session('status'))
               <div class="alert alert-success">
                    {{ session('status') }}
               </div>
          @endif
          <div class="btn_show_container">
               <button class="btn_show print-btn" onclick="show()">Ambil Mata Kuliah</button>
          </div>
          <form class="ambil-mk hidden" id="ambil_mk" action="{{url('site/ambil-mk')}}" method="POST" >
               @csrf
               <label for="mk-diambil">Mata Kuliah</label>
               <select name ="mk-diambil" required>
                    @foreach($mk_tayang as $mkt)
                    <option value={{ $mkt ->kode_mk }}> {{ $mkt ->nama_mk }}</option>
                    @endforeach
               </select>
               <button type="submit"name="tambah-mk" class="print-btn">Ambil</button>
          </form>

          <table>
               <tr>
                 <th>No</th>
                 <th>Kode MK</th>
                 <th>Nama MK</th>
                 <th>Semester</th>
                 <th>Pengampu</th>
                 <?php if(session("role_id")== 3) : ?>
                     <th>Aksi</th>
                    <?php endif; ?>
               </tr>
               @foreach ($matkul_diambil as $mkd)
               <tr>
                   <th>{{ $loop->iteration }}</th>
                   <th>{{ $mkd->kode_mk}}</th>
                   <th>{{ $mkd->nama_mk }}</th>
                   <th>{{ $mkd->semester }}</th>
                   <th>{{ $mkd->nama }}</th>
                   @if (session("role_id") == 3)
                        <td>
                              <a class="delete" href="{{url('site/ambil-mk',[session('nim_nip'),$mkd->kode_mk])}}" 
                              onclick = "return confirm('Anda yakin untuk menghapus Mata Kuliah?')">Del</a>
                        </td>
                   @endif
               </tr>
              @endforeach
             </table>
     </main> 
     
     <script>
               function show(){
                    const form = document.getElementById("ambil_mk");
                    form.classList.toggle("hidden");
               }
     </script>
</body>
</html>