@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Pelanggan</h5>
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
            <div class="table-responsive mt-4">
                <table id="example1" class="table table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Foto</th>
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
                ajax: {
                    url: "{{ route('sistem.pelanggan.list') }}",
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'foto',
                        name: 'foto'
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
