<?php

namespace App\Http\Controllers\Sistem;

use App\Helpers\AllHelper;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SaldoController extends Controller
{
    // Menampilkan halaman Saldo
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.saldo.index', compact('setting'));
    }
    
    // proses menampilkan data saldo dengan datatables
    public function listData()
    {
        $data = Setting::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('saldo', function($row) {
                $saldo = AllHelper::rupiah($row->saldo);
                return $saldo;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.saldo.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right: 10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action', 'saldo'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman edit Saldo
    public function edit($id)
    {
        $setting = Setting::first();
        $saldo = Setting::find($id);

        return view('sistem.saldo.edit', compact('setting', 'saldo'));
    }

    // Proses mengupdate data saldo di database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'saldo' => 'required'
        ],
        [
            'required' => ':attribute wajib diisi !!!'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $setting = Setting::find($id);
        $setting->saldo = $request->get('saldo');
        $setting->save();

        return redirect()->route('sistem.saldo')->with('success', 'Berhasil mengupdate saldo.');
    }
}
