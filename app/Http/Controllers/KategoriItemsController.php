<?php

namespace App\Http\Controllers;

use App\Models\KategoriItem;
use App\Models\MasterItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KategoriItemsController extends Controller
{
    public function index()
    {
        $kategori = KategoriItem::get();

        return view('kategori_items.index', compact('kategori'));
    }

    public function show($id)
    {
        $kategori = KategoriItem::with('masterItems')->findOrFail($id);

        return view('kategori_items.show', compact('kategori'));
    }

    public function create()
    {
        return view('kategori_items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required|unique:kategori_items,kode'
        ]);

        KategoriItem::create([
            'nama' => $request->nama,
            'kode' => $request->kode
        ]);

        return redirect('/kategori-items');
    }

    public function search(Request $request)
    {
        $nama = $request->nama;
        $kode = $request->kode;

        $data_search = KategoriItem::query();

        if (!empty($kode)) $data_search = $data_search->where('kode', 'LIKE', '%' . $kode . '%');
        if (!empty($nama)) $data_search = $data_search->where('nama', 'LIKE', '%' . $nama . '%');

        $data_search = $data_search->select('id', 'kode', 'nama')->get();

        return json_encode([
            'status' => 200,
            'data' => $data_search
        ]);
    }

    public function cetak_pdf($id)
    {
        $data['kategori'] = KategoriItem::with('masterItems')->findOrFail($id);
        $data['now'] = Carbon::now();

        $pdf = Pdf::loadView('kategori_items.kategori_pdf', $data);
        return $pdf->download();
    }
}
