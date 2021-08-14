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
        <p align="center"><b>Laporan Stok Gudang</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width:95%">
            <tr style="background: palegreen">
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Barang</th>
                <th rowspan="2">Jenis</th>
                <th colspan="1">Stok Awal</th>
                <th colspan="1">Masuk</th>
                <th colspan="1">Keluar</th>
                <th colspan="1">Stok Akhir</th>
            </tr>
            
            <tr bgcolor="yellow">
                <th>{{$tanggalStok->tanggal}}</th>
                <th>{{$tanggalStok->tanggal}}</th>
                <th>{{$tanggalStok->tanggal}}</th>
                <th>{{$tanggalStok->tanggal}}</th>
            </tr>
            @foreach ($stokPerTanggal as $spt)
            <tr align="center">
                <td>{{$loop->iteration}}</td>
                <td>{{$spt->barangz->nm_brg}}</td>
                <td>{{$spt->jenisz->jns_brg}}</td>
                <td>{{$spt->awal}}</td>
                <td>{{$spt->stok_masuk}}</td>
                <td>{{$spt->stok_keluar}}</td>
                <td>{{$spt->akhir}}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>