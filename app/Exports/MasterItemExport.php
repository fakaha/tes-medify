<?php

namespace App\Exports;

use App\Models\MasterItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class MasterItemExport implements FromCollection, WithColumnFormatting, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $no = 1;

    public function collection()
    {
        return MasterItem::with('kategoriItems')->get();
    }

    public function map($item): array
    {
        $kategori = $item->kategoriItems
            ->pluck('nama')
            ->implode(', ');

        $hargaJual = $item->harga_beli + ($item->harga_beli * $item->laba /100);

        return [
            $this->no++,            // 1. No
            $kategori,              // 2. Nama kategori
            $item->nama,            // 3. Nama item
            $item->supplier,        // 4. Supplier
            $item->harga_beli,      // 5. Harga
            $item->laba,            // 6. Laba
            $hargaJual,             // 7. Harga jual
        ];
    }
    
    public function headings(): array
    {
        return [
            'No',
            'Kategori',
            'Nama Item',
            'Supplier',
            'Harga',
            'Laba',
            'Harga Jual',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'F' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'G' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }
}
