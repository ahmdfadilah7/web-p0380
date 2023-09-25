@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <!--  Row 1 -->
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row alig n-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold"> Total Penjualan</h5>
                                @php
                                    $totaltahun = array();
                                @endphp
                                @foreach ($transaksitahun as $no => $value)
                                    @if($value->diskon <> null)
                                        @php
                                            $harga_jual = $value->harga_diskon
                                        @endphp
                                    @else
                                        @php
                                            $harga_jual = $value->harga_barang
                                        @endphp
                                    @endif
                                    @php
                                        $totaltahun[] = $value->total;
                                        $totalkeuntungantahun[] = ($harga_jual - $value->harga_beli)*$value->kuantitas;
                                    @endphp
                                @endforeach
                            <h4 class="fw-semibold mb-3">{{  AllHelper::rupiah(array_sum($totaltahun)) }}</h4>
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
        <div class="col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row alig n-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold"> Total Pembelian</h5>
                                @php
                                    $totalpembelian = array();
                                @endphp
                                @foreach ($pembelian as $no => $value)
                                    @php
                                        $totalpembelian[] = $value->total;
                                    @endphp
                                @endforeach
                            <h4 class="fw-semibold mb-3">{{  AllHelper::rupiah(array_sum($totalpembelian)) }}</h4>
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
        <div class="col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row alig n-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold"> Jumlah Saldo</h5>
                                @php
                                    $saldo = $setting->saldo;
                                @endphp
                            <h4 class="fw-semibold mb-3">{{  AllHelper::rupiah($saldo) }}</h4>
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
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-9 fw-semibold">Keuntungan di Tanggal {{ date('d M Y') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Kode Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Keuntungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = array();
                                    $totalkeuntungan = array();
                                @endphp
                                @foreach ($transaksiharian as $no => $value)
                                    @if($value->diskon <> null)
                                        @php
                                            $harga_jual = $value->harga_diskon
                                        @endphp
                                    @else
                                        @php
                                            $harga_jual = $value->harga_barang
                                        @endphp
                                    @endif
                                    @php
                                        $total[] = $value->total;
                                        $totalkeuntungan[] = ($harga_jual - $value->harga_beli)*$value->kuantitas
                                    @endphp
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $value->kode_invoice }}</td>
                                        <td>{{ $value->kode_barang }}</td>
                                        <td class="text-right">{{ AllHelper::rupiah($value->harga_beli) }}</td>
                                        <td class="text-right">
                                            @if($value->diskon <> null)                                        
                                            {{ AllHelper::rupiah($value->harga_diskon) }}
                                            @else
                                            {{ AllHelper::rupiah($value->harga_barang) }}
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $value->kuantitas }}</td>
                                        <td class="text-right">{{ AllHelper::rupiah($value->total) }}</td>
                                        <td class="text-right">{{ AllHelper::rupiah(($harga_jual - $value->harga_beli)*$value->kuantitas) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6" class="text-center"><strong>Total Keseluruhan</strong></td>
                                    <td class="text-right"><strong>{{ AllHelper::rupiah(array_sum($total)) }}</strong></td>
                                    <td class="text-right"><strong>{{ AllHelper::rupiah(array_sum($totalkeuntungan)) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-9 fw-semibold">Keuntungan di Bulan {{ date('M Y') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Kode Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Keuntungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalbulan = array();
                                    $totalkeuntunganbulan = array();
                                @endphp
                                @foreach ($transaksibulan as $no => $value)
                                    @if($value->diskon <> null)
                                        @php
                                            $harga_jual = $value->harga_diskon
                                        @endphp
                                    @else
                                        @php
                                            $harga_jual = $value->harga_barang
                                        @endphp
                                    @endif
                                    @php
                                        $totalbulan[] = $value->total;
                                        $totalkeuntunganbulan[] = ($harga_jual - $value->harga_beli)*$value->kuantitas;
                                    @endphp
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $value->kode_invoice }}</td>
                                        <td>{{ $value->kode_barang }}</td>
                                        <td class="text-right">{{ AllHelper::rupiah($value->harga_beli) }}</td>
                                        <td class="text-right">
                                            @if($value->diskon <> null)                                        
                                            {{ AllHelper::rupiah($value->harga_diskon) }}
                                            @else
                                            {{ AllHelper::rupiah($value->harga_barang) }}
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $value->kuantitas }}</td>
                                        <td class="text-right">{{ AllHelper::rupiah($value->total) }}</td>
                                        <td class="text-right">{{ AllHelper::rupiah(($harga_jual - $value->harga_beli)*$value->kuantitas) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6" class="text-center"><strong>Total Keseluruhan</strong></td>
                                    <td class="text-right"><strong>{{ AllHelper::rupiah(array_sum($totalbulan)) }}</strong></td>
                                    <td class="text-right"><strong>{{ AllHelper::rupiah(array_sum($totalkeuntunganbulan)) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-9 fw-semibold">Keuntungan di Tahun {{ date('Y') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Kode Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Keuntungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totaltahun = array();
                                    $totalkeuntungantahun = array();
                                @endphp
                                @foreach ($transaksitahun as $no => $value)
                                    @if($value->diskon <> null)
                                        @php
                                            $harga_jual = $value->harga_diskon
                                        @endphp
                                    @else
                                        @php
                                            $harga_jual = $value->harga_barang
                                        @endphp
                                    @endif
                                    @php
                                        $totaltahun[] = $value->total;
                                        $totalkeuntungantahun[] = ($harga_jual - $value->harga_beli)*$value->kuantitas;
                                    @endphp
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $value->kode_invoice }}</td>
                                        <td>{{ $value->kode_barang }}</td>
                                        <td class="text-right">{{ AllHelper::rupiah($value->harga_beli) }}</td>
                                        <td class="text-right">
                                            @if($value->diskon <> null)                                        
                                            {{ AllHelper::rupiah($value->harga_diskon) }}
                                            @else
                                            {{ AllHelper::rupiah($value->harga_barang) }}
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $value->kuantitas }}</td>
                                        <td class="text-right">{{ AllHelper::rupiah($value->total) }}</td>
                                        <td class="text-right">{{ AllHelper::rupiah(($harga_jual - $value->harga_beli)*$value->kuantitas) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6" class="text-center"><strong>Total Keseluruhan</strong></td>
                                    <td class="text-right"><strong>{{ AllHelper::rupiah(array_sum($totaltahun)) }}</strong></td>
                                    <td class="text-right"><strong>{{ AllHelper::rupiah(array_sum($totalkeuntungantahun)) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-6 col-sm-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row alig n-items-start">
                                <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold"> Pendapatan di Tanggal {{ date('d M Y') }}</h5>
                                    @php
                                        $total = array();
                                    @endphp
                                    @foreach($invoiceselesaiharian->get() as $key => $value)
                                        @php
                                            $total[$key] = $value->total_invoice - $value->ongkos_kirim
                                        @endphp
                                    @endforeach
                                    <h4 class="fw-semibold mb-3">{{  AllHelper::rupiah(array_sum($total)) }}</h4>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="row alig n-items-start">
                                <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold"> Pendapatan di bulan {{ date('M Y') }}</h5>
                                    @php
                                        $total = array();
                                    @endphp
                                    @foreach($invoiceselesai->get() as $key => $value)
                                        @php
                                            $total[$key] = $value->total_invoice - $value->ongkos_kirim
                                        @endphp
                                    @endforeach
                                    <h4 class="fw-semibold mb-3">{{  AllHelper::rupiah(array_sum($total)) }}</h4>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="row alig n-items-start">
                                <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold"> Pendapatan di Tahun {{ date('Y') }}</h5>
                                    @php
                                        $total = array();
                                    @endphp
                                    @foreach($invoiceselesaitahun->get() as $key => $value)
                                        @php
                                            $total[$key] = $value->total_invoice - $value->ongkos_kirim
                                        @endphp
                                    @endforeach
                                    <h4 class="fw-semibold mb-3">{{  AllHelper::rupiah(array_sum($total)) }}</h4>
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
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Penjualan di Tanggal {{ date('d M Y') }}</h5>
                        </div>
                    </div>
                    <div id="chart1"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Penjualan di bulan {{ date('M Y') }}</h5>
                        </div>
                    </div>
                    <div id="chart2"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Penjualan di Tahun {{ date('Y') }}</h5>
                        </div>
                    </div>
                    <div id="chart3"></div>
                </div>
            </div>
        </div>         --}}
    </div>
@endsection

@section('script')
    <script>
        var maxharian = '{{ $jumlahinvoiceharian }}';
        var selesaiharian = '{{ $invoiceselesaiharian->count() }}';
        var dibatalkanharian = '{{ $invoicedibatalkanharian->count() }}';

        var max = '{{ $jumlahinvoice }}';
        var selesai = '{{ $invoiceselesai->count() }}';
        var dibatalkan = '{{ $invoicedibatalkan->count() }}';

        var maxtahun = '{{ $jumlahinvoicetahun }}';
        var selesaitahun = '{{ $invoiceselesaitahun->count() }}';
        var dibatalkantahun = '{{ $invoicedibatalkantahun->count() }}';

        var chart = {
            series: [{
                    name: 'Penjualan',
                    data: [selesaiharian, dibatalkanharian]
                },
            ],

            chart: {
                type: "bar",
                height: 345,
                offsetX: -15,
                toolbar: {
                    show: true
                },
                foreColor: "#adb0bb",
                fontFamily: 'inherit',
                sparkline: {
                    enabled: false
                },
            },


            colors: ["#5D87FF", "#49BEFF"],


            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "35%",
                    borderRadius: [6],
                    borderRadiusApplication: 'end',
                    borderRadiusWhenStacked: 'all'
                },
            },
            markers: {
                size: 0
            },

            dataLabels: {
                enabled: false,
            },


            legend: {
                show: false,
            },


            grid: {
                borderColor: "rgba(0,0,0,0.1)",
                strokeDashArray: 3,
                xaxis: {
                    lines: {
                        show: false,
                    },
                },
            },

            xaxis: {
                type: "category",
                categories: ["Selesai", "Dibatalkan"],
                labels: {
                    style: {
                        cssClass: "grey--text lighten-2--text fill-color"
                    },
                },
            },


            yaxis: {
                show: true,
                min: 0,
                max: parseInt(maxharian),
                tickAmount: 4,
                labels: {
                    style: {
                        cssClass: "grey--text lighten-2--text fill-color",
                    },
                },
            },
            stroke: {
                show: true,
                width: 3,
                lineCap: "butt",
                colors: ["transparent"],
            },


            tooltip: {
                theme: "light"
            },

            responsive: [{
                breakpoint: 600,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 3,
                        }
                    },
                }
            }]


        };

        var chart2 = {
            series: [{
                    name: 'Penjualan',
                    data: [selesai, dibatalkan]
                },
            ],

            chart: {
                type: "bar",
                height: 345,
                offsetX: -15,
                toolbar: {
                    show: true
                },
                foreColor: "#adb0bb",
                fontFamily: 'inherit',
                sparkline: {
                    enabled: false
                },
            },


            colors: ["#5D87FF", "#49BEFF"],


            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "35%",
                    borderRadius: [6],
                    borderRadiusApplication: 'end',
                    borderRadiusWhenStacked: 'all'
                },
            },
            markers: {
                size: 0
            },

            dataLabels: {
                enabled: false,
            },


            legend: {
                show: false,
            },


            grid: {
                borderColor: "rgba(0,0,0,0.1)",
                strokeDashArray: 3,
                xaxis: {
                    lines: {
                        show: false,
                    },
                },
            },

            xaxis: {
                type: "category",
                categories: ["Selesai", "Dibatalkan"],
                labels: {
                    style: {
                        cssClass: "grey--text lighten-2--text fill-color"
                    },
                },
            },


            yaxis: {
                show: true,
                min: 0,
                max: parseInt(max),
                tickAmount: 4,
                labels: {
                    style: {
                        cssClass: "grey--text lighten-2--text fill-color",
                    },
                },
            },
            stroke: {
                show: true,
                width: 3,
                lineCap: "butt",
                colors: ["transparent"],
            },


            tooltip: {
                theme: "light"
            },

            responsive: [{
                breakpoint: 600,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 3,
                        }
                    },
                }
            }]


        };

        var chart3 = {
            series: [{
                    name: 'Penjualan',
                    data: [selesaitahun, dibatalkantahun]
                },
            ],

            chart: {
                type: "bar",
                height: 345,
                offsetX: -15,
                toolbar: {
                    show: true
                },
                foreColor: "#adb0bb",
                fontFamily: 'inherit',
                sparkline: {
                    enabled: false
                },
            },


            colors: ["#5D87FF", "#49BEFF"],


            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "35%",
                    borderRadius: [6],
                    borderRadiusApplication: 'end',
                    borderRadiusWhenStacked: 'all'
                },
            },
            markers: {
                size: 0
            },

            dataLabels: {
                enabled: false,
            },


            legend: {
                show: false,
            },


            grid: {
                borderColor: "rgba(0,0,0,0.1)",
                strokeDashArray: 3,
                xaxis: {
                    lines: {
                        show: false,
                    },
                },
            },

            xaxis: {
                type: "category",
                categories: ["Selesai", "Dibatalkan"],
                labels: {
                    style: {
                        cssClass: "grey--text lighten-2--text fill-color"
                    },
                },
            },


            yaxis: {
                show: true,
                min: 0,
                max: parseInt(maxtahun),
                tickAmount: 4,
                labels: {
                    style: {
                        cssClass: "grey--text lighten-2--text fill-color",
                    },
                },
            },
            stroke: {
                show: true,
                width: 3,
                lineCap: "butt",
                colors: ["transparent"],
            },


            tooltip: {
                theme: "light"
            },

            responsive: [{
                breakpoint: 600,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 3,
                        }
                    },
                }
            }]


        };

        var chart = new ApexCharts(document.querySelector("#chart1"), chart);
        var chart2 = new ApexCharts(document.querySelector("#chart2"), chart2);
        var chart3 = new ApexCharts(document.querySelector("#chart3"), chart3);
        chart.render();
        chart2.render();
        chart3.render();
    </script>
@endsection
