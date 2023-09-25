@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
<div class="row">
    <div class="col-md-7 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Pembelian</h5>
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
                {!! Form::open(['method' => 'post', 'route' => ['sistem.pembelian.store'], 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Supplier</label>
                        <select name="supplier" class="form-control">
                            <option value="">- Pilih -</option>
                            @foreach ($supplier as $value)
                                <option value="{{ $value->id }}">{{ $value->nama_supplier.' - '.$value->toko_supplier }}</option>
                            @endforeach
                        </select>
                        <i class="text-danger">{{ $errors->first('supplier') }}</i>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Kode Barang</label>
                        <select name="kode_barang" id="KodeBarang" class="form-control">
                            <option value="">- Pilih -</option>
                            @foreach ($barang as $value)
                                <option value="{{ $value->id }}">{{ $value->kode_barang.' - '.$value->nama_barang }}</option>
                            @endforeach
                        </select>
                        <i class="text-danger">{{ $errors->first('kode_barang') }}</i>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Harga (RP)</label>
                        <input type="number" name="harga" id="Harga" class="form-control" disabled>
                        <i class="text-danger">{{ $errors->first('harga') }}</i>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" id="Jumlah" class="form-control">
                        <i class="text-danger">{{ $errors->first('jumlah') }}</i>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Ongkos Kirim (RP)</label>
                        <input type="number" name="ongkir" id="Ongkir" class="form-control">
                        <i class="text-danger">{{ $errors->first('ongkir') }}</i>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Total (RP)</label>
                        <input type="number" name="total" id="Total" class="form-control" disabled>
                        <i class="text-danger">{{ $errors->first('total') }}</i>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <a href="{{ route('sistem.pembelian') }}" class="btn btn-warning">Back</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-md-5 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row alig n-items-start">
                    <div class="col-8">
                        <h5 class="card-title mb-9 fw-semibold">Jumlah Saldo</h5>                        
                        <h4 class="fw-semibold mb-3">{{ AllHelper::rupiah($setting->saldo) }}</h4>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-end">
                            <div
                                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                <span class="fw-semibold">RP</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

    <script>
        $('#KodeBarang').on('change', function() {
            var id = $('#KodeBarang').val()
            var url = '{{ url("listbarang") }}/'+id
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#Harga').val(data.harga_beli)
                    console.log(data)
                }
            });
        })

        $('#Jumlah').on('keyup', function() {
            var price = $('#Harga').val()
            var quantity = $('#Jumlah').val();
            var total = parseInt(price)*parseInt(quantity);
            $('#Total').val(total);
        })

        $('#Ongkir').on('keyup', function() {
            var price = $('#Harga').val()
            var quantity = $('#Jumlah').val()
            var ongkir = $('#Ongkir').val()
            var total = (parseInt(price)*parseInt(quantity))+parseInt(ongkir);
            $('#Total').val(total);
        })
    </script>

@endsection