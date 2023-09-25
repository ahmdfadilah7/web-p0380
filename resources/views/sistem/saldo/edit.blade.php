@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Saldo</h5>
            {!! Form::model($saldo, ['method' => 'post', 'route' => ['sistem.saldo.update', $saldo->id], 'enctype' => 'multipart/form-data']) !!}
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="" class="form-label">Saldo</label>
                    <input type="number" name="saldo" class="form-control" value="{{ $saldo->saldo }}">
                    <i class="text-danger">{{ $errors->first('saldo') }}</i>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('sistem.saldo') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection