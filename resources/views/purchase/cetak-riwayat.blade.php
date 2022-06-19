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
    <title>Cetak Riwayat Belanja</title>
</head>
<body>
    <div class="form-group">
        <p align="center"><b>Riwayat Belanja</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width:95%">
            <tr style="background: palegreen">
                <th>No</th>
                <th>Suplier</th>
                <th>Nama Barang</th>
                <th>Jenis</th>
                <th>QTY</th>
                <th>Harga per Unit</th>
                <th>Total Harga</th>
            </tr>
            @foreach ($stokPerTanggal as $spt)
            <tr align="center">
                <td>{{$loop->iteration}}</td>
                <td>{{$spt->suplier->name}}</td>
                <td>{{$spt->brg1->nm_brg}}</td>
                <td>{{$spt->jns1->jns_brg}}</td>
                <td>{{$spt->jumlah}} Kg</td>
                <td>@currency($spt->hrg_item)</td>
                <td>@currency($spt->total)</td>
                {{-- <td>{{$spt->akhir}}</td> --}}
            </tr>
            @endforeach
        </table>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>