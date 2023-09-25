@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<div class="container pt-5 pb-3">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Categories</span>
            </h5>
            <div class="bg-light p-4 mb-30">
                <div>
                    <h6>
                        <a href="{{ route('product') }}" class="text-categories text-uppercase @if(Request::segment(2)=='') {{ 'active' }} @endif">All</a>
                    </h6>
                </div>
                @foreach($kategori as $key => $value)
                    <div>
                        <h6>
                            <a 
                                href="{{ route('product.category', str_replace(' ', '-', $value->name)) }}" 
                                class="text-categories text-uppercase @if(Request::segment(3)==str_replace(' ', '-', $value->name)) {{ 'active' }} @endif
                            ">
                                {{ $value->name }}
                            </a>
                        </h6>
                    </div>
                @endforeach
            </div>
            <!-- Price End -->
            
        </div>

        <div class="col-md-7 col-sm-12">
            <div class="row product-lists">

                @foreach ($barang as $value)
                    
                    <div class="col-lg-4 col-md-6 col-sm-12 text-center {{ strtolower(str_replace(' ', '-', $value->kategori)) }}">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ url($value->foto_barang) }}" alt="">                                
                            </div>
                            <div class="text-center py-4 p-2">
                                @if(Str::length(Auth::guard('webpelanggan')->user()) > 0)
                                    <p class="h6 text-decoration-none text-truncate" onclick="get_menu({{ $value->id }})">
                                        {{ $value->nama_barang }}
                                    </p>
                                @else
                                    <p class="h6 text-decoration-none text-truncate">{{ $value->nama_barang }}</p>
                                @endif
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    @if($value->diskon <> '')
                                        <h5>{{ AllHelper::rupiah($value->harga_diskon) }}</h5>
                                        <h6 class="text-muted ml-2">
                                            <del>{{ AllHelper::rupiah($value->harga_barang) }}</del>
                                            <p class="text-danger">{{ $value->diskon }}%</p>
                                        </h6>
                                    @else
                                        <h5>{{ AllHelper::rupiah($value->harga_barang) }}</h5>
                                    @endif
                                </div>
                                <h6 class="mt-2">
                                    @if ($value->stok==0)
                                        <i class="text-danger">Stok Habis</i>
                                    @else
                                        Stok : {{ $value->stok }}
                                    @endif
                                </h6>
                                @if(Str::length(Auth::guard('webpelanggan')->user()) > 0)
                                    @if($value->stok==0)
                                        <a disabled class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Tambah Keranjang</a>
                                    @else
                                        <a onclick="get_menu({{ $value->id }})" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Tambah Keranjang</a>
                                    @endif
                                @endif                        
                            </div>
                        </div>
                    </div>
        
                @endforeach
                
            </div>
        
            <div class="row">
                <div class="col-md-12 text-center">
                    {{ $barang->links() }}
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Sortir</span>
            </h5>
            <div class="bg-light p-4 mb-30">
                <div>
                    <h6>
                        <a href="{{ route('product.sortir', 'terbaru') }}" class="text-categories text-uppercase @if(Request::segment(3)=='terbaru') {{ 'active' }} @endif">Terbaru</a>
                    </h6>
                </div>
                <div>
                    <h6>
                        <a href="{{ route('product.sortir', 'lama') }}" class="text-categories text-uppercase @if(Request::segment(3)=='lama') {{ 'active' }} @endif">Lama</a>
                    </h6>
                </div>
            </div>
            <!-- Price End -->
            
        </div>
    </div>    
</div>

@include('layouts.partials.addcart')

@endsection