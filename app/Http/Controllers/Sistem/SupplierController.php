<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    // Menampilkan halaman supplier
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.supplier.index', compact('setting'));
    }

    // proses menampilkan data supplier dengan datatables
    public function listData()
    {
        $data = Supplier::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.supplier.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right: 10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                $btn .= '<a href="'.route('sistem.supplier.delete', $row->id).'" class="btn btn-danger btn-sm">
                            <i class="ti ti-trash"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah supplier
    public function create()
    {
        $setting = Setting::first();

        return view('sistem.supplier.add', compact('setting'));
    }

    // Proses menambahkan data supplier ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_supplier' => 'required',
            'toko_supplier' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi !!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }
        
        Supplier::create([
            'nama_supplier' => $request->get('nama_supplier'),
            'toko_supplier' => $request->get('toko_supplier'),
        ]);

        return redirect()->route('sistem.supplier')->with('success', 'Berhasil menambahkan supplier.');
    }

    // Menampilkan halaman edit supplier
    public function edit($id)
    {
        $setting = Setting::first();
        $supplier = supplier::find($id);

        return view('sistem.supplier.edit', compact('setting', 'supplier'));
    }

    // Proses merubah data supplier di database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_supplier' => 'required',
            'toko_supplier' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $supplier = Supplier::find($id);
        $supplier->nama_supplier = $request->get('nama_supplier');
        $supplier->toko_supplier = $request->get('toko_supplier');
        $supplier->save();

        return redirect()->route('sistem.supplier')->with('success', 'Berhasil merubah supplier.');
    }

    // Proses menghapus supplier dari database
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();

        return redirect()->route('sistem.supplier')->with('success', 'Berhasil menghapus supplier.');
    }
}
