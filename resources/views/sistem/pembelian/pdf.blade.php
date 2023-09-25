<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <center>
        <h5>
            Laporan Pembelian
        </h5>
    </center>
    @if ($tanggal == '')
        <p>Laporan Keseluruhan</p>
    @else
        <p>Tanggal : {{ date('d M Y', strtotime($tanggal)) }}</p>
    @endif
    <table class="table table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pembelian</th>
                <th>Kode Barang</th>
                <th>Tanggal</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Ongkir</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembelian as $no => $value)
                @php
                    $total[] = $value->total;
                @endphp
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $value->kode_pembelian }}</td>
                    <td>{{ $value->kode_barang }}</td>
                    <td>{{ date('Y-m-d', strtotime($value->created_at)) }}</td>
                    <td>{{ AllHelper::rupiah_v2($value->harga) }}</td>
                    <td>{{ $value->jumlah }}</td>
                    <td>{{ AllHelper::rupiah_v2($value->ongkos_kirim) }}</td>
                    <td>{{ AllHelper::rupiah_v2($value->total) }}</td>
                </tr>
            @endforeach
                <tr>
                   <td colspan="7" class="text-center"><strong>Total Keseluruhan</strong></td> 
                   <td><strong>{{ AllHelper::rupiah_v2(array_sum($total)) }}</strong></td> 
                </tr>
        </tbody>
    </table>
</body>
</html>