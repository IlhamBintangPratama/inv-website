<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <style>
        table.static
        {
            position: relative;
            border: 1px solid #543535;
        }
    </style>
    <title>Cetak Laporan</title>
</head>
<body>
    <div class="form-group">
        <p align="center"><b>Laporan Hasil Perhitungan</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width:95%">
            <tr style="background: palegreen">
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Jenis</th>
                <th>Periode</th>
                <th>Permintaan</th>
                <th>EOQ</th>
                <th>Frekuensi</th>
                <th>Leadtime</th>
                <th>ROP</th>
            </tr>
            @foreach ($resultPerTanggal as $item)
            <tr>
                <td align="center">{{$loop->iteration}}</td>
                <td align="center">{{$item->tanggal}}</td>
                <td align="center">{{$item->brgs->nm_brg}}</td>
                <td align="center">{{$item->jnsz->jns_brg}}</td>
                <td align="center">{{$item->periode}} Hari</td>
                <td align="center">{{$item->permintaan}} Kg</td>
                <td align="center">{{$item->eoq}} Kg</td>
                <td align="center">{{$item->frekuensi}}x</td>
                <td align="center">{{$item->leadtime}} Hari</td>
                <td align="center">{{$item->rop}} Kg</td>
            </tr>
            @endforeach
        </table>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>