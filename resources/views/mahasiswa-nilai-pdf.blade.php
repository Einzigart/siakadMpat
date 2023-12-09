<!DOCTYPE html>
<html>

<head>
    <title>{{ $nim }}-{{ $nama }}</title>
</head>

<body>
    <style type="text/css">
        body {
            margin: 50px;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        td,
        th {
            border: 1px solid rgb(0, 0, 0);
            text-align: center;
            padding: 8px;
        }

        .container tr:nth-child(even) {
            background-color: #dddddd;
        }

        .identitas {
            text-align: left;
            padding: 10px;
            margin: auto;
            border: none;

        }
    </style>
    <main>
        <div >
            <table>
                <tr >
                    <td class="identitas" style="width:50px">Nama</td>
                    <td class="identitas">: {{ $nama }}</td>
                </tr>
                <tr>
                    <td class="identitas">NIM</td>
                    <td class="identitas">: {{ $nim }}</td>
                </tr>
            </table>
        </div>

        <table class="container">
            <tr>
                <th>No</th>
                <th>Kode MK</th>
                <th>Nama MK</th>
                <th>Nilai</th>
            </tr>
            @foreach ($nilai as $n)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $n->kode_mk }}</td>
                    <td>{{ $n->nama_mk }}</td>
                    <td>{{ $n->nilai_mk }}</td>
                </tr>
            @endforeach
        </table>
    </main>

</body>

</html>
