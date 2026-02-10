@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="form-group mb-2">
                <a href="/kategori-items/create" class="btn btn-secondary">+ Tambah Kategori</a>
            </div>

            <div class="mb-3">
                <input type="text" id="filter-nama" placeholder="Nama kategori" class="form-control mb-1">
                <input type="text" id="filter-kode" placeholder="Kode kategori" class="form-control mb-1">
                <button class="btn btn-primary mt-1 btn-get-data" id="btn-get-data">Filter</button>
                <button type="button" class="btn btn-secondary btn-reset-data">Reset</button>
            </div>

            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori as $k)
                    <tr>
                        <td>{{ $k->kode }}</td>
                        <td>
                            <a href="{{ route('kategori.show', $k->id) }}">
                                {{ $k->nama }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    // Buat table global supaya bisa diakses di getData()
    var table = $('#table').DataTable({
        searching: false,
        ordering: true,
        paging: true
    });

    // Event tombol filter
    $('.btn-get-data').click(function() {
        getData();
    });

    function getData(){
        var filter_nama = $('#filter-nama').val();
        var filter_kode = $('#filter-kode').val();

        table.clear().draw(); // clear table sebelum diisi

        $.ajax({
            url: '{{ url("kategori-items/search") }}',
            data: { nama: filter_nama, kode: filter_kode },
            dataType: 'json',
            success: function(res){
                $.each(res.data, function(i, k){
                    table.row.add([
                        k.kode,
                        k.nama,
                        `<a href="{{ url('kategori-items') }}/${k.id}" class="btn btn-primary">View</a>`
                    ]).draw(false);
                });
                $('#loading-filter').hide();
            },
            error: function(){
                alert('Gagal mengambil data.');
                $('#loading-filter').hide();
            }
        });
    }
});
</script>
@endsection
