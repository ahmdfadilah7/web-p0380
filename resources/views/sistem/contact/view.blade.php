@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Contact</h5>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" name="nama_barang" class="form-control" value="{{ $contact->nama_pengirim }}" disabled>
                        <i class="text-danger">{{ $errors->first('nama_barang') }}</i>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="text" name="nama_barang" class="form-control" value="{{ $contact->email_pengirim }}" disabled>
                        <i class="text-danger">{{ $errors->first('nama_barang') }}</i>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Subject</label>
                        <input type="text" name="harga_barang" class="form-control" value="{{ $contact->subjek_pengirim }}" disabled>
                        <i class="text-danger">{{ $errors->first('harga_barang') }}</i>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Pesan</label>
                        <textarea name="" class="form-control" rows="10" disabled>{{ $contact->pesan }}</textarea>
                        <i class="text-danger">{{ $errors->first('stok') }}</i>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <a href="{{ route('sistem.contact.delete', $contact->id) }}" class="btn btn-danger">Hapus</a>
                        <a href="{{ route('sistem.contact') }}" class="btn btn-warning">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection