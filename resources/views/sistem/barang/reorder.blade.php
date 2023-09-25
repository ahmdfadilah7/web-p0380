@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Daftar Re Order Barang</h5>
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
                    <a href="{{ route('sistem.barang') }}" class="btn btn-primary">Kembali</a>
                </div>
                <div>
                    {!! Form::open(['method' => 'get', 'route' => ['sistem.barang.cetak'], 'class' => 'd-flex']) !!}
                        <label for="" class="form-label" style="margin-right: 10px;">Format</label>
                        <select name="format" class="form-control" style="margin-right: 10px;">
                            <option value="">- Pilih - </option>
                            <option value="PDF">PDF</option>
                            <option value="EXCEL">EXCEL</option>
                        </select>
                        <i class="text-danger" style="margin-right: 10px">{{ $errors->first('format') }}</i>
                        <button type="submit" class="btn btn-danger">Cetak</button>
                    {!! Form::close() !!}
                </div>
            </div>
            @endif
            <div class="table-responsive mt-4">
                <p>Tanggal : {{ date('d M Y') }}</p>
                <table id="example1" class="table table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Foto</th>
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
                                <td>
                                    <img src="{{ url($value->foto_barang) }}" width="50">    
                                </td>
                                <td>{{ $value->stok }}</td>
                                <td>{{ $value->stok_minimum }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
