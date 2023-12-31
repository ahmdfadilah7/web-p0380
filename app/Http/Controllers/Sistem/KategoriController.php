<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    // Menampilkan halaman kategori barang
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.kategori.index', compact('setting'));
    }

    // proses menampilkan data kategori barang dengan datatables
    public function listData()
    {
        $data = Kategori::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                if (Auth::guard('websistem')->user()->role=='Administrator') {
                    $btn = '';
                } else {
                    $btn = '<a href="'.route('sistem.kategori.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right: 10px;">
                                <i class="ti ti-edit"></i>
                            </a>';
                    $btn .= '<a href="'.route('sistem.kategori.delete', $row->id).'" class="btn btn-danger btn-sm">
                                <i class="ti ti-trash"></i>
                            </a>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah kategori barang
    public function create()
    {
        $setting = Setting::first();

        return view('sistem.kategori.add', compact('setting'));
    }

    // Proses menambahkan data kategori barang ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'singkatan' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        Kategori::create([
            'name' => $request->get('name'),
            'singkatan' => $request->get('singkatan'),
        ]);

        return redirect()->route('sistem.kategori')->with('success', 'Berhasil menambahkan kategori barang.');
    }

    // Menampilkan halaman edit kategori barang
    public function edit($id)
    {
        $setting = Setting::first();
        $kategori = Kategori::find($id);

        return view('sistem.kategori.edit', compact('setting', 'kategori'));
    }

    // Proses merubah data kategori barang di database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'singkatan' => 'required'
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }        

        $kategori = Kategori::find($id);
        $kategori->name = $request->get('name');
        $kategori->singkatan = $request->get('singkatan');
        $kategori->save();

        return redirect()->route('sistem.kategori')->with('success', 'Berhasil merubah kategori barang.');
    }

    // Proses menghapus kategori barang dari database
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        return redirect()->route('sistem.kategori')->with('success', 'Berhasil menghapus kategori barang.');
    }
}
