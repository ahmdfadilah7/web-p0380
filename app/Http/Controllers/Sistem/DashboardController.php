<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Pembelian;
use App\Models\Setting;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Menampilkan halaman dashboard
    public function index()
    {
        $setting = Setting::first();
        $jumlahinvoiceharian = Invoice::whereDate('created_at', '=', date('Y-m-d'))->count();
        $invoiceselesaiharian = Invoice::where('status', '4')->whereDate('created_at', '=', date('Y-m-d'));
        $invoicedibatalkanharian = Invoice::where('status', '5')->whereDate('created_at', '=', date('Y-m-d'));

        $jumlahinvoice = Invoice::where('created_at', 'LIKE', '%'.date('Y-m').'%')->count();
        $invoiceselesai = Invoice::where('status', '4')->where('created_at', 'LIKE', '%'.date('Y-m').'%');
        $invoicedibatalkan = Invoice::where('status', '5')->where('created_at', 'LIKE', '%'.date('Y-m').'%');

        $jumlahinvoicetahun = Invoice::whereYear('created_at', '=', date('Y'))->count();
        $invoiceselesaitahun = Invoice::where('status', '4')->whereYear('created_at', '=', date('Y'));
        $invoicedibatalkantahun = Invoice::where('status', '5')->whereYear('created_at', '=', date('Y'));
        $invoiceselesaibulan = $invoiceselesai->get();
        $transaksiharian = Transaksi::join('barangs', 'transaksis.barang_id', 'barangs.id')
            ->join('invoices', 'transaksis.invoice_id', 'invoices.id')
            ->where(function($q) use($invoiceselesaiharian){
                foreach ($invoiceselesaiharian->get() as $key => $value) {
                    $q->orWhere('transaksis.invoice_id', $value->id);
                }
            })
            ->where('invoices.status', '4')
            ->select(
                'transaksis.*', 
                'invoices.kode_invoice',
                'barangs.kode_barang', 
                'barangs.harga_barang', 
                'barangs.harga_beli', 
                'barangs.harga_diskon', 
                'barangs.diskon'
                )
            ->get();
        $transaksibulan = Transaksi::join('barangs', 'transaksis.barang_id', 'barangs.id')
            ->join('invoices', 'transaksis.invoice_id', 'invoices.id')
            ->where(function($q) use($invoiceselesaibulan){
                foreach ($invoiceselesaibulan as $key => $value) {
                    $q->orWhere('transaksis.invoice_id', $value->id);
                }
            })
            ->where('invoices.status', '4')
            ->select(
                'transaksis.*', 
                'invoices.kode_invoice',
                'barangs.kode_barang', 
                'barangs.harga_barang', 
                'barangs.harga_beli', 
                'barangs.harga_diskon', 
                'barangs.diskon'
                )
            ->get();
        
        $transaksitahun = Transaksi::join('barangs', 'transaksis.barang_id', 'barangs.id')
            ->join('invoices', 'transaksis.invoice_id', 'invoices.id')
            ->where(function($q) use($invoiceselesaitahun){
                foreach ($invoiceselesaitahun->get() as $key => $value) {
                    $q->orWhere('transaksis.invoice_id', $value->id);
                }
            })
            ->where('invoices.status', '4')
            ->select(
                'transaksis.*', 
                'invoices.kode_invoice',
                'barangs.kode_barang', 
                'barangs.harga_barang', 
                'barangs.harga_beli', 
                'barangs.harga_diskon', 
                'barangs.diskon'
                )
            ->get();
        
        $pembelian = Pembelian::get();

        return view('sistem.dashboard.index', 
            compact(
                'setting', 
                'invoiceselesai', 
                'invoiceselesaiharian', 
                'invoiceselesaitahun', 
                'invoicedibatalkan', 
                'invoicedibatalkanharian', 
                'invoicedibatalkantahun', 
                'jumlahinvoice', 
                'jumlahinvoiceharian',
                'jumlahinvoicetahun',
                'transaksiharian',
                'transaksibulan',
                'transaksitahun',
                'pembelian'
            ));
    }
}
