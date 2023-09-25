<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PelangganController extends Controller
{
    // Menampilkan halaman pelanggan 
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.pelanggan.index', compact('setting'));
    }

    // proses menampilkan data pelanggan  dengan datatables
    public function listData()
    {
        $data = Pelanggan::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('foto', function($row) {
                if ($row->foto <> '') {
                    $img = '<img src="'.url($row->foto).'" width="50">';
                } else {
                    $img = '<img src="'.url('images/user-1.jpg').'" width="50">';
                }

                return $img;
            })
            ->addColumn('action', function($row) {
                if (Auth::guard('websistem')->user()->role=='Pegawai') {
                    $btn = '<a href="'.route('sistem.pelanggan.delete', $row->id).'" class="btn btn-danger btn-sm">
                                <i class="ti ti-trash"></i>
                            </a>';
                } else {
                    $btn = '';
                }
                return $btn;
            })
            ->rawColumns(['action', 'foto'])
            ->make(true);
        
        return $datatables;
    }

    // Proses menghapus pelanggan dari database
    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();

        return redirect()->route('sistem.pelanggan')->with('success', 'Berhasil menghapus pelanggan.');
    }
}
