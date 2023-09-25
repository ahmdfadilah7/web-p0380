<?php

namespace App\Http\Controllers\Sistem;

use App\Helpers\AllHelper;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pembelian;
use App\Models\Setting;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

use PDF;

class PembelianController extends Controller
{
    // Menampilkan halaman pembelian
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.pembelian.index', compact('setting'));
    }

    // proses menampilkan data pembelian dengan datatables
    public function listData()
    {
        $data = Pembelian::join('barangs', 'pembelians.barang_id', 'barangs.id')
                ->join('suppliers', 'pembelians.supplier_id', 'suppliers.id')
                ->select('pembelians.*', 'barangs.nama_barang', 'suppliers.nama_supplier');
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('harga', function($row) {
                $harga = AllHelper::rupiah($row->harga);
                return $harga;
            })
            ->addColumn('ongkir', function($row) {
                $harga = AllHelper::rupiah($row->ongkos_kirim);
                return $harga;
            })
            ->addColumn('total', function($row) {
                $harga = AllHelper::rupiah($row->total);
                return $harga;
            })
            ->rawColumns(['harga', 'total', 'ongkir'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan laporan pembelian
    public function laporan(Request $request)
    {
        $tanggal = $request->get('tanggal');
        $setting = Setting::first();
        $check = Pembelian::join('barangs', 'pembelians.barang_id', 'barangs.id')
                ->join('suppliers', 'pembelians.supplier_id', 'suppliers.id')
                ->whereDate('pembelians.created_at', '=', date('Y-m-d', strtotime($tanggal)))
                ->select(
                    'pembelians.*', 
                    'barangs.nama_barang', 
                    'barangs.kode_barang', 
                    'suppliers.nama_supplier');
        if ($tanggal <> '') {
            if ($check->count() > 0) {
                $pembelian = $check->get();
                return view('sistem.pembelian.laporan', compact('setting', 'pembelian', 'tanggal'));
            } else {
                return back()->with('danger', 'Tidak ada data di tanggal '.$tanggal);
            }
        } else {
            $pembelian = Pembelian::join('barangs', 'pembelians.barang_id', 'barangs.id')
                        ->join('suppliers', 'pembelians.supplier_id', 'suppliers.id')
                        ->select(
                            'pembelians.*', 
                            'barangs.nama_barang', 
                            'barangs.kode_barang', 
                            'suppliers.nama_supplier')
                        ->get();
            return view('sistem.pembelian.laporan', compact('setting', 'pembelian', 'tanggal'));
        }
        
    }

    // Proses cetak
    public function cetak(Request $request) 
    {
        $setting = Setting::first();
        $tanggal = $request->get('tanggal');
        if ($request->get('format') == 'PDF') {
            if ($tanggal <> '') {
                $pembelian = Pembelian::join('barangs', 'pembelians.barang_id', 'barangs.id')
                    ->join('suppliers', 'pembelians.supplier_id', 'suppliers.id')
                    ->whereDate('pembelians.created_at', '=', date('Y-m-d', strtotime($tanggal)))
                    ->select(
                        'pembelians.*', 
                        'barangs.nama_barang', 
                        'barangs.kode_barang', 
                        'suppliers.nama_supplier')
                    ->get();
                view()->share(['setting' => $setting, 'pembelian' => $pembelian, 'tanggal' => $tanggal]);
                $pdf = PDF::loadview('sistem.pembelian.pdf');
                return $pdf->download('Laporan-Pembelian-'.str_replace(' ', '-', $setting->nama_website).'-'.Str::random(4).'.pdf');
            } else {
                $pembelian = Pembelian::join('barangs', 'pembelians.barang_id', 'barangs.id')
                    ->join('suppliers', 'pembelians.supplier_id', 'suppliers.id')
                    ->select(
                        'pembelians.*', 
                        'barangs.nama_barang', 
                        'barangs.kode_barang', 
                        'suppliers.nama_supplier')
                    ->get();
                view()->share(['setting' => $setting, 'pembelian' => $pembelian, 'tanggal' => $tanggal]);
                $pdf = PDF::loadview('sistem.pembelian.pdf');
                return $pdf->download('Laporan-Pembelian-'.str_replace(' ', '-', $setting->nama_website).'-'.Str::random(4).'.pdf');
            }
        }
    }

    // Menampilkan halaman tambah pembelian
    public function create() 
    {
        $setting = Setting::first();
        $barang = Barang::get();
        $supplier = Supplier::get();

        return view('sistem.pembelian.add', compact('setting', 'barang', 'supplier'));
    }

    // Mengambil data barang
    public function ListBarang($id) 
    {
        $barang = Barang::find($id);
        
        return json_encode($barang);
    }

    // Proses menambahkan pembelian
    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'supplier' => 'required',
            'kode_barang' => 'required',
            'jumlah' => 'required',
            'ongkir' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $pembelian = Pembelian::selectRaw('MAX(RIGHT(kode_pembelian, 4)) as kode_max');

        if ($pembelian->count() > 0) {
            $urutan = (int) $pembelian->first()->kode_max;
            $urutan++;
            $kodepembelian = 'PMB'.sprintf('%05s', $urutan);
        }else {
            $kodepembelian = 'PMB'.sprintf('%05s', 1);
        }

        $barang = Barang::find($request->get('kode_barang'));
        $total = ($request->get('jumlah')*$barang->harga_beli)+$request->get('ongkir');

        $saldo = Setting::first();

        if ($total > $saldo->saldo) {
            return back()->with('danger', 'Saldo tidak mencukupi!!. Silahkan konfirmasi ke Administrator');
        }

        $saldo->saldo = $saldo->saldo - $total;
        $saldo->save();

        Pembelian::create([
            'kode_pembelian' => $kodepembelian,
            'supplier_id' => $request->get('supplier'),
            'barang_id' => $request->get('kode_barang'),
            'jumlah' => $request->get('jumlah'),
            'harga' => $barang->harga_beli,
            'ongkos_kirim' => $request->get('ongkir'),
            'total' => $total,
            'created_by' => Auth::guard('websistem')->user()->id,
            'updated_by' => Auth::guard('websistem')->user()->id,
        ]);

        $barang->stok = $barang->stok + $request->get('jumlah');
        $barang->save();

        return redirect()->route('sistem.pembelian')->with('success', 'Berhasil menambahkan pembelian.');
    }

    // Proses menghapus pembelian
    public function destroy($id)
    {
        $pembelian = Pembelian::find($id);
        $pembelian->delete();

        $barang = Barang::find($pembelian->barang_id);
        $barang->stok = $barang->stok - $pembelian->jumlah;
        $barang->save();

        return redirect()->route('sistem.pembelian')->with('success', 'Berhasil menghapus pembelian.');
    }
}
