@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')

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
            @if(Auth::guard('websistem')->user()->role=='Pegawai')
            <div class="d-flex justify-content-between">
                <div>
                    <a href="{{ route('sistem.pembelian') }}" class="btn btn-primary">Kembali</a>
                </div>
                <div>
                    {!! Form::open(['method' => 'get', 'route' => ['sistem.pembelian.cetak'], 'class' => 'd-flex']) !!}
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
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
                @if ($tanggal == '')
                    <p>Laporan Keseluruhan</p>
                @else
                    <p>Tanggal : {{ date('d M Y', strtotime($tanggal)) }}</p>
                @endif
                <table id="example1" class="table table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pembelian</th>
                            <th>Kode Barang</th>
                            <th>Tanggal</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Ongkir</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelian as $no => $value)
                            @php
                                $total[] = $value->total;
                            @endphp
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $value->kode_pembelian }}</td>
                                <td>{{ $value->kode_barang }}</td>
                                <td>{{ date('Y-m-d', strtotime($value->created_at)) }}</td>
                                <td>{{ AllHelper::rupiah($value->harga) }}</td>
                                <td>{{ $value->jumlah }}</td>
                                <td>{{ AllHelper::rupiah($value->ongkos_kirim) }}</td>
                                <td>{{ AllHelper::rupiah($value->total) }}</td>
                            </tr>
                        @endforeach
                            <tr>
                               <td colspan="7" class="text-center"><strong>Total Keseluruhan</strong></td> 
                               <td><strong>{{ AllHelper::rupiah(array_sum($total)) }}</strong></td> 
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
