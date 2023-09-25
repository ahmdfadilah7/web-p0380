@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data Pembelian</h5>
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
                <div>
                    <a href="{{ route('sistem.pembelian.add') }}" class="btn btn-primary"><i class="ti ti-plus"></i></a>
                </div>
                <div style="width: 50%">
                    {!! Form::open(['method' => 'get', 'route' => ['sistem.pembelian.laporan'], 'class' => 'd-flex justify-content-between']) !!}
                    <input type="date" name="tanggal" class="form-control" style="width:60%;">
                    <button type="submit" class="btn btn-danger">Laporan Pembelian</button>
                    {!! Form::close() !!}
                </div>
            </div>
            @endif
            <div class="table-responsive mt-4">
                <table id="example1" class="table table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pembelian</th>
                            <th>Nama Supplier</th>
                            <th>Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Ongkos Kirim</th>
                            <th>Total</th>
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
                ajax: {
                    url: "{{ route('sistem.pembelian.list') }}",
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
                        data: 'kode_pembelian',
                        name: 'kode_pembelian'
                    },
                    {
                        data: 'nama_supplier',
                        name: 'nama_supplier',
                        className: 'text-center'
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'harga',
                        name: 'harga',
                        className: 'text-right'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah',
                        className: 'text-center'
                    },
                    {
                        data: 'ongkir',
                        name: 'ongkir',
                        className: 'text-right'
                    },
                    {
                        data: 'total',
                        name: 'total',
                        className: 'text-right'
                    },
                ]
            });
        });
    </script>

@endsection
