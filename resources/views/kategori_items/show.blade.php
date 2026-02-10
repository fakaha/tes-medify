@extends('layouts.app')

@section('content')
<div>
<h2>{{ $kategori->nama }}</h2>
<p>Kode: {{ $kategori->kode }}</p>

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
@endsection