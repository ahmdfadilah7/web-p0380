@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Pembelian</h5>
            {!! Form::model($pembelian, ['method' => 'post', 'route' => ['sistem.pembelian.update', $pembelian->id], 'enctype' => 'multipart/form-data']) !!}
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="" class="form-label">Nama Supplier</label>
                    <input type="text" name="nama_supplier" class="form-control" value="{{ $pembelian->nama_supplier }}">
                    <i class="text-danger">{{ $errors->first('nama_supplier') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Barang</label>
                    <select name="barang_id" class="form-control">
                        <option value="">- Pilih -</option>
                        @foreach ($barang as $value)
                            <option value="{{ $value->id }}" @if($pembelian->barang_id == $value->id) {{ 'selected' }} @endif>{{ $value->nama_barang }}</option>
                        @endforeach
                    </select>
                    <i class="text-danger">{{ $errors->first('barang_id') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" value="{{ $pembelian->harga }}">
                    <i class="text-danger">{{ $errors->first('harga') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="{{ $pembelian->jumlah }}">
                    <i class="text-danger">{{ $errors->first('jumlah') }}</i>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('sistem.pembelian') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection