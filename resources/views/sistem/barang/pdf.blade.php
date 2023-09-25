<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Re Order Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <center>
        <h5>
            Daftar Re Order Barang
        </h5>
    </center>
    <p>Tanggal : {{ date('d M Y') }}</p>
    <table class="table table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Stok Minimum</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $no => $value)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $value->kode_barang }}</td>
                    <td>{{ $value->nama_barang }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->stok }}</td>
                    <td>{{ $value->stok_minimum }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>