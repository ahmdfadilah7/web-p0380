@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Supplier</h5>
            {!! Form::open(['method' => 'post', 'route' => ['sistem.supplier.store'], 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group mb-3">
                    <label for="" class="form-label">Nama Supplier</label>
                    <input type="text" name="nama_supplier" class="form-control" value="{{ old('nama_supplier') }}">
                    <i class="text-danger">{{ $errors->first('nama_supplier') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Toko Supplier</label>
                    <input type="text" name="toko_supplier" class="form-control" value="{{ old('toko_supplier') }}">
                    <i class="text-danger">{{ $errors->first('toko_supplier') }}</i>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('sistem.supplier') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection