@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<!-- Carousel Start -->
<div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($slider as $key => $value)
            <li data-target="#header-carousel" data-slide-to="{{ $key }}" @if($key==0) class="active" @endif></li>
        @endforeach
    </ol>
    <div class="carousel-inner">

        @foreach ($slider as $key => $value)
            <div class="carousel-item position-relative @if($key==0) active @endif" style="height: 430px;">
                <img class="position-absolute w-100 h-100" src="{{ url($value->gambar) }}" style="object-fit: cover;">
                {{-- <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Men Fashion</h1>
                        <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                        <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                    </div>
                </div> --}}
            </div>
        @endforeach
        
    </div>
</div>
<!-- Carousel End -->

<div class="container pt-5 pb-3">
    <div class="row">
        <div class="col-md-12">
            <div class="product-filters">
                <ul>
                    <li class="active" data-filter="*">All</li>
                    @foreach ($kategori as $value)
                        <li data-filter=".{{ strtolower(str_replace(' ', '-', $value->name)) }}">{{ $value->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="row product-lists">

        @foreach ($barang as $value)
            
            <div class="col-lg-3 col-md-6 col-sm-12 text-center {{ strtolower(str_replace(' ', '-', $value->kategori)) }}">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ url($value->foto_barang) }}" alt="">                        
                    </div>
                    <div class="text-center py-4">
                        @if(Str::length(Auth::guard('webpelanggan')->user()) > 0)
                            <a class="h6 text-decoration-none text-truncate" onclick="get_menu({{ $value->id }})">{{ $value->nama_barang }}</a>
                        @else
                            <a class="h6 text-decoration-none text-truncate">{{ $value->nama_barang }}</a>
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

@include('layouts.partials.addcart')

@endsection