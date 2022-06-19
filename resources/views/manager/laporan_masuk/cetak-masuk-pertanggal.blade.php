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
        <p align="center"><b>Laporan Masuk</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width:95%">
            <tr style="background: palegreen">
                <th>No</th>
                <th>Tanggal</th>
                <th>Suplier</th>
                <th>Nama Barang</th>
                <th>Jenis</th>
                <th>QTY</th>
                <th>Harga Item</th>
                <th>Total</th>
            </tr>
            @foreach ($resultPerTanggal as $item)
            <tr>
                <td align="center">{{$loop->iteration}}</td>
                <td align="center">{{$item->tanggal}}</td>
                <td align="center">{{$item->suplier->name}}</td>
                <td align="center">{{$item->brg1->nm_brg}}</td>
                <td align="center">{{$item->jns1->jns_brg}}</td>
                <td align="center">{{$item->jumlah}} Kg</td>
                <td align="center">@currency($item->hrg_item)</td>
                <td align="center">@currency($item->total)</td>
            </tr>
            @endforeach
        </table>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>