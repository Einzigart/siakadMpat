<!DOCTYPE html>
<html>

<head>
    <title>{{ $nim }}-{{ $nama }}</title>
</head>

<body>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0 50px 50px 50px;
        }

        table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: Arial, sans-serif;
            width: 100%;
            text-align: center
        }

        thead tr,
        table th {
            background-color: var(--white-bg);
            color: var(--black);
            text-align: center;
        }

        td,
        th {
            padding: 12px 15px;
            border: 1px solid #dddddd;
        }

        tr:nth-child(even),
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .identitas {
            text-align: left;
            padding: 10px;
            margin: auto;
            border: none;
            font-size: 14px
        }

        .borderNone {
            border: none !important;
        }
    </style>
    <table style="border-collapse: collapse; position:absolute; width:100%">
        <tr>
            <td style="width: max-content;padding:0;" class="borderNone"><img
                    src="https://pasca.uns.ac.id/wp-content/uploads/2016/06/cropped-logo-universitas-sebelas-maret-surakarta.png"
                    alt="Logo UNS" style="max-width: 75px; " /></td>
            <td style="font-size: 12px ;line-height: 12px; width:100%" class="borderNone">KEMENTERIAN PENDIDIKAN DAN
                KEBUDAYAAN,<br>
                RISET, DAN TEKNOLOGI<br>
                UNIVERSITAS SEBELAS MARET<br>
                FAKULTAS TEKNIK<br>
                Jalan Insinyur Sutami Nomor 36A Kentingan Surakarta 57126<br>
                Telepon (0271) 647069, Faksimile (0271) 662118<br>
                Laman https://ft.uns.ac.id, Surel : teknik@ft.uns.ac.id<br></td>
        </tr>
    </table>
    <hr style="border: 1px solid #000; margin-top: 130px; margin-bottom: 20px ;"> <!-- Horizontal Rule -->
    <main>
        <div>
            <table >
                <tr>
                    <td class="identitas" style="width:50px ;background-color: #f2f2f200;">Nama</td>
                    <td class="identitas" >: {{ $nama }}</td>
                </tr>
                <tr>
                    <td class="identitas" style="width:50px ;background-color: #f2f2f200;">NIM</td>
                    <td class="identitas" style="background-color: #f2f2f200">: {{ $nim }}</td>
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
