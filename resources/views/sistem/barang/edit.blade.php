@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Data Barang</h5>
            {!! Form::model($barang, ['method' => 'post', 'route' => ['sistem.barang.update', $barang->id], 'enctype' => 'multipart/form-data']) !!}
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="" class="form-label">Kategori</label>
                    <select name="kategori_id" class="form-control">
                        <option value="0">- Pilih -</option>
                        @foreach($kategori as $value)
                            <option value="{{ $value->id }}" @if($barang->kategori_id==$value->id) {{ 'selected' }} @endif>{{ $value->name }}</option>
                        @endforeach
                    </select>
                    <i class="text-danger">{{ $errors->first('name') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}">
                    <i class="text-danger">{{ $errors->first('nama_barang') }}</i>
                </div>
                <div class="form-group mb-3">
                    @if($barang->foto_barang <> '')
                        <label for="" class="form-label">Foto Barang Sebelumnya</label><br>
                        <img src="{{ url($barang->foto_barang) }}" width="100"><br>
                    @endif
                    <label for="" class="form-label">Foto Barang</label>
                    <input type="file" name="foto_barang" class="form-control">
                    <i class="text-danger">{{ $errors->first('foto_barang') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Harga Beli</label>
                    <input type="number" name="harga_beli" class="form-control" value="{{ $barang->harga_beli }}">
                    <i class="text-danger">{{ $errors->first('harga_beli') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Harga Jual</label>
                    <input type="number" name="harga_barang" id="hargajual" class="form-control" value="{{ $barang->harga_barang }}">
                    <i class="text-danger">{{ $errors->first('harga_barang') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Diskon (%)</label>
                    <input type="number" name="diskon" id="diskon" class="form-control" value="{{ $barang->diskon }}">
                    <i class="text-danger">{{ $errors->first('diskon') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Harga Diskon</label>
                    <input type="number" name="harga_diskon" id="hargadiskon" class="form-control" value="{{ $barang->harga_diskon }}" disabled>
                    <i class="text-danger">{{ $errors->first('harga_diskon') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Stok Barang</label>
                    <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}">
                    <i class="text-danger">{{ $errors->first('stok') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Stok Minimum</label>
                    <input type="number" name="stok_minimum" class="form-control" value="{{ $barang->stok_minimum }}">
                    <i class="text-danger">{{ $errors->first('stok_minimum') }}</i>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('sistem.barang') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('script')

    <script>
        $('#diskon').on('keyup', function() {
            var harga = $('#hargajual').val()
            var diskon = $('#diskon').val()
            var hargadiskon = (parseInt(diskon)/100)*parseInt(harga)
            var hargasetelahdiskon = harga - hargadiskon;
            $('#hargadiskon').val(hargasetelahdiskon)
        })
    </script>

@endsection