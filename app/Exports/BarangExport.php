<?php

namespace App\Exports;

use App\Models\Barang;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BarangExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $setting = Setting::first();
        $barang = Barang::join('kategoris', 'barangs.kategori_id', 'kategoris.id')                
                    ->whereColumn('stok', '<=', 'stok_minimum')
                    ->orderBy('barangs.id', 'DESC')
                    ->select('barangs.*', 'kategoris.name')
                    ->get();
        return view('sistem.barang.excel', compact('setting', 'barang'));
    }

    // use Exportable;

    // public function collection()
    // {
    //     return Barang::join('kategoris', 'barangs.kategori_id', 'kategoris.id')                
    //             ->whereColumn('stok', '<=', 'stok_minimum')
    //             ->orderBy('barangs.id', 'DESC')
    //             ->select('barangs.*', 'kategoris.name')
    //             ->get();
    // }

    // public function headings(): array
    // {
    //     return [
    //         1 => [
    //             'Daftar Barang'
    //         ],
    //         2 => [
    //             'Kode Barang',
    //             'Nama Barang',
    //             'Kategori',
    //             'Stok',
    //             'Stok Minimum',
    //         ]
    //     ];
    // }

    // public function map($barang): array
    // {
    //     return [
    //         $barang->kode_barang,
    //         $barang->nama_barang,
    //         $barang->name,
    //         $barang->stok,
    //         $barang->stok_minimum
    //     ];
    // }
}
