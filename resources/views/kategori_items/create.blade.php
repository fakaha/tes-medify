@extends('layouts.app')

@section('content')
<form method="POST" action="/kategori-items/store">
    @csrf

    <div>
        <label>Kode</label>
        <input type="text" name="kode">
    </div>

    <div>
        <label>Nama</label>
        <input type="text" name="nama">
    </div>

    <button type="submit">Simpan</button>
</form>
@endsection