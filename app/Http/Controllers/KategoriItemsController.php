<?php

namespace App\Http\Controllers;

use App\Models\KategoriItem;
use App\Models\MasterItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
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
        $query = KategoriItem::query();
        if ($request->nama) $query->where('nama','LIKE','%'.$request->nama.'%');
        if ($request->kode) $query->where('kode','LIKE','%'.$request->kode.'%');

        $data = $query->get();

        return response()->json(['data' => $data]);
    }

    public function cetak_pdf()
    {
        $kategori = KategoriItem::all();

        $pdf = Pdf::loadView('kategori_items.kategori_pdf', ['kategori' => $kategori]);
        return $pdf->stream();
    }
}
