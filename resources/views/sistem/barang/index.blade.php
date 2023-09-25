@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data Barang</h5>
            @if($msg = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>{{ $msg }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif ($msg = Session::get('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p>{{ $msg }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(Auth::guard('websistem')->user()->role=='Pegawai')
            <div class="d-flex justify-content-between">
                <a href="{{ route('sistem.barang.add') }}" class="btn btn-primary"><i class="ti ti-plus"></i></a>
                <a href="{{ route('sistem.barang.reorder') }}" class="btn btn-warning">Daftar Re Order Barang</a>
            </div>
            @endif
            <div class="table-responsive mt-4">
                <table id="example1" class="table table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Foto</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Diskon(%)</th>
                            <th>Harga Diskon</th>
                            <th>Stok</th>
                            <th>Stok Minimum</th>
                            @if (Auth::guard('websistem')->user()->role=='Pegawai')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('#example1').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                "ordering": 'true',
                "createdRow": function(row, data, dataIndex){
                    if (data.stok <= data.stok_minimum) {
                        $(row).addClass('redClass')
                    }
                    console.log(data.stok)
                },
                ajax: {
                    url: "{{ route('sistem.barang.list') }}",
                    data: function(d) {}
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'kode_barang',
                        name: 'kode_barang'
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'nama_kategori',
                        name: 'kategoris.name'
                    },
                    {
                        data: 'foto_barang',
                        name: 'foto_barang'
                    },
                    {
                        data: 'harga_beli',
                        name: 'harga_beli'
                    },
                    {
                        data: 'harga_barang',
                        name: 'harga_barang'
                    },
                    {
                        data: 'diskon',
                        name: 'diskon'
                    },
                    {
                        data: 'harga_diskon',
                        name: 'harga_diskon'
                    },
                    {
                        data: 'stok',
                        name: 'stok'
                    },
                    {
                        data: 'stok_minimum',
                        name: 'stok_minimum'
                    },
                    @if (Auth::guard('websistem')->user()->role=='Pegawai')
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    @endif
                ]
            });
        });
    </script>

@endsection
