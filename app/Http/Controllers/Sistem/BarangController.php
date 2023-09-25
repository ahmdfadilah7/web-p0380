<?php

namespace App\Http\Controllers\Sistem;

use App\Exports\BarangExport;
use App\Helpers\AllHelper;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use Excel;

class BarangController extends Controller
{
    // Menampilkan halaman barang
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.barang.index', compact('setting'));
    }

    // proses menampilkan data barang dengan datatables
    public function listData()
    {
        $data = Barang::join('kategoris', 'barangs.kategori_id', 'kategoris.id')
            ->orderBy('id', 'DESC')
            ->select('barangs.*', 'kategoris.name as nama_kategori');
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('foto_barang', function($row) {
                if ($row->foto_barang <> '') {
                    $img = '<img src="'.url($row->foto_barang).'" width="50">';
                } else {
                    $img = '';
                }
                return $img;
            })
            ->addColumn('harga_beli', function($row) {
                if ($row->harga_beli <> '') {
                    $hrg = AllHelper::rupiah($row->harga_beli);
                } else {
                    $hrg = '';
                }
                return $hrg;
            })
            ->addColumn('harga_diskon', function($row) {
                if ($row->harga_diskon <> '') {
                    $hrg = AllHelper::rupiah($row->harga_diskon);
                } else {
                    $hrg = '';
                }
                return $hrg;
            })
            ->addColumn('diskon', function($row) {
                if ($row->diskon <> '') {
                    $diskon = $row->diskon.'%';
                } else {
                    $diskon = '';
                }
                return $diskon;
            })
            ->addColumn('harga_barang', function($row) {
                $hrg = AllHelper::rupiah($row->harga_barang);
                return $hrg;
            })
            ->addColumn('action', function($row) {
                if (Auth::guard('websistem')->user()->role=='Administrator') {
                    $btn = '';
                } else {
                    $btn = '<a href="'.route('sistem.barang.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right: 10px;">
                                <i class="ti ti-edit"></i>
                            </a>';
                    $btn .= '<a href="'.route('sistem.barang.delete', $row->id).'" class="btn btn-danger btn-sm">
                                <i class="ti ti-trash"></i>
                            </a>';
                }
                return $btn;
            })
            ->rawColumns(['action', 'foto_barang', 'harga_beli', 'harga_barang', 'diskon', 'harga_diskon'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman re-order barang
    public function reOrder() {
        $setting = Setting::first();

        $barang = Barang::join('kategoris', 'barangs.kategori_id', 'kategoris.id')                
                ->whereColumn('stok', '<=', 'stok_minimum')
                ->orderBy('barangs.id', 'DESC')
                ->select('barangs.*', 'kategoris.name')
                ->get();

        return view('sistem.barang.reorder', compact('setting', 'barang'));
    }

    // Proses cetak PDF
    public function cetak(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'format' => 'required'
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $setting = Setting::first();

        if ($request->get('format') == 'PDF') {
            $barang = Barang::join('kategoris', 'barangs.kategori_id', 'kategoris.id')                
                    ->whereColumn('stok', '<=', 'stok_minimum')
                    ->orderBy('barangs.id', 'DESC')
                    ->select('barangs.*', 'kategoris.name')
                    ->get();
    
            view()->share(['setting' => $setting, 'barang' => $barang]);
            $pdf = PDF::loadview('sistem.barang.pdf');
            return $pdf->download('Daftar-Barang-REORDER-'.str_replace(' ', '-', $setting->nama_website).'-'.Str::random(4).'.pdf');
        } else {
            return Excel::download(new BarangExport, 'Daftar-Barang-REORDER-'.str_replace(' ', '-', $setting->nama_website).'-'.Str::random(4).'.xlsx');
        }
    }

    // Menampilkan halaman tambah kategori barang
    public function create()
    {
        $setting = Setting::first();
        $kategori = Kategori::get();

        return view('sistem.barang.add', compact('setting', 'kategori'));
    }

    // Proses menambahkan data barang ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'foto_barang' => 'required|mimes:jpg,jpeg,svg,png,gif,webp',
            'harga_beli' => 'required',
            'harga_barang' => 'required',
            'stok' => 'required',
            'stok_minimum' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $kategori = Kategori::find($request->get('kategori_id'));
        
        $barang = Barang::where('kategori_id', $request->get('kategori_id'))
                ->where('kode_barang', '<>', null)
                ->selectRaw('MAX(RIGHT(kode_barang, 4)) as kode_max');

        if ($barang->count() > 0) {
            $urutan = (int) $barang->first()->kode_max;
            $urutan++;
            $kodebarang = $kategori->singkatan.sprintf('%05s', $urutan);
        }else {
            $kodebarang = $kategori->singkatan.sprintf('%05s', 1);
        }

        $foto = $request->file('foto_barang');
        $namafoto = 'Barang-'.str_replace(' ', '-', $request->get('nama_barang')).'-'.Str::random(4).'.'.$foto->extension();
        $tujuan = 'images';
        $foto->move(public_path($tujuan), $namafoto);
        $fotoNama = $tujuan.'/'.$namafoto;

        if ($request->diskon <> '') {
            $diskon = ($request->get('diskon')/100) * $request->get('harga_barang');
            $harga_diskon = $request->get('harga_barang') - $diskon;
        } else {
            $diskon = '';
            $harga_diskon = '';
        }

        Barang::create([
            'kode_barang' => $kodebarang,
            'nama_barang' => $request->get('nama_barang'),
            'kategori_id' => $request->get('kategori_id'),
            'foto_barang' => $fotoNama,
            'harga_beli' => $request->get('harga_beli'),
            'harga_barang' => $request->get('harga_barang'),
            'diskon' => $diskon,
            'harga_diskon' => $harga_diskon,
            'stok' => $request->get('stok'),
            'stok_minimum' => $request->get('stok_minimum'),
            'created_by' => Auth::guard('websistem')->user()->id,
            'updated_by' => Auth::guard('websistem')->user()->id,
        ]);

        return redirect()->route('sistem.barang')->with('success', 'Berhasil menambahkan barang.');
    }

    // Menampilkan halaman edit barang
    public function edit($id)
    {
        $setting = Setting::first();
        $barang = Barang::find($id);
        $kategori = Kategori::get();

        return view('sistem.barang.edit', compact('setting', 'barang', 'kategori'));
    }

    // Proses merubah data barang di database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'foto_barang' => 'mimes:png,jpg,jpeg,svg,gif,webp',
            'harga_beli' => 'required',
            'harga_barang' => 'required',
            'stok' => 'required',
            'stok_minimum' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $kategori = Kategori::find($request->get('kategori_id'));        
        $barang = Barang::where('kategori_id', $request->get('kategori_id'))
                ->where('kode_barang', '<>', null)
                ->selectRaw('MAX(RIGHT(kode_barang, 4)) as kode_max');

        if ($barang->count() > 0) {
            $urutan = (int) $barang->first()->kode_max;
            $urutan++;
            $kodebarang = $kategori->singkatan.sprintf('%05s', $urutan);
        }else {
            $kodebarang = $kategori->singkatan.sprintf('%05s', 1);
        }

        if ($request->foto_barang <> '') {
            $foto = $request->file('foto_barang');
            $namafoto = 'Barang-'.str_replace(' ', '-', $request->get('nama_barang')).'-'.Str::random(4).'.'.$foto->extension();
            $tujuan = 'images';
            $foto->move(public_path($tujuan), $namafoto);
            $fotoNama = $tujuan.'/'.$namafoto;
        }

        $barang = Barang::find($id);
        $barang->kategori_id = $request->get('kategori_id');
        $barang->nama_barang = $request->get('nama_barang');
        if ($barang->kode_barang == '') {
            $barang->kode_barang = $kodebarang;
        }
        if ($request->foto_barang <> '') {
            File::delete($barang->foto_barang);

            $barang->foto_barang = $fotoNama;
        }
        $barang->harga_beli = $request->get('harga_beli');
        $barang->harga_barang = $request->get('harga_barang');
        if ($request->diskon <> '') {
            $barang->diskon = $request->get('diskon');

            $diskon = ($barang->diskon/100) * $barang->harga_barang;
            $harga_diskon = $barang->harga_barang - $diskon;
            $barang->harga_diskon = $harga_diskon;
        }
        $barang->stok = $request->get('stok');
        $barang->stok_minimum = $request->get('stok_minimum');
        $barang->updated_by = Auth::guard('websistem')->user()->id;
        $barang->save();

        return redirect()->route('sistem.barang')->with('success', 'Berhasil merubah barang.');
    }

    // Proses menghapus barang dari database
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        File::delete($barang->foto_barang);

        return redirect()->route('sistem.barang')->with('success', 'Berhasil menghapus barang.');
    }
}
