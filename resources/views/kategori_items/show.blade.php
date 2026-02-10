@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Kategori: {{ $kategori->nama }}</h2>
            <p>Kode: {{ $kategori->kode }}</p>

            <div class="d-flex justify-content-end mb-3">
                <a href="{{route('kategori.cetak_pdf', $kategori->id) }}" class="btn btn-primary">PRINT</a>
            </div>
            <hr>

            <h4>Daftar Item</h4>

            <ul>
            @forelse($kategori->masterItems as $item)
                <li>
                    {{ $item->kode }} - {{ $item->nama }}
                </li>
            @empty
                <li>Tidak ada item</li>
            @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection