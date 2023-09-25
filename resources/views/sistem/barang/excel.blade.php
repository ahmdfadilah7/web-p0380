<table style="width: 100%; border: 2px solid #000;">
    <thead>
        <tr>
            <th colspan="6" style="font-size: 13px; font-weight: bold; text-align:center;">Daftar Barang Re Order {{ $setting->nama_website }}</th>
        </tr>
        <tr>
            <th colspan="6">Tanggal : {{ date('d M Y') }}</th>
        </tr>
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