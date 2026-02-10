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
            </div>

            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    let table;

    $(document).ready(function() {
        table = $('#table').DataTable({
            searching: false,
            order: [[0, 'desc']],
        });
        getData();
    });

    $('.btn-get-data').click(function() {
        getData();
    });

    function getData() {
    let filter_kode = $('#filter-kode').val();
    let filter_nama = $('#filter-nama').val();

    table.clear();

    $.ajax({
        url: '{{ url("kategori-items/search") }}',
        dataType: 'json',
        data: {
            kode: filter_kode,
            nama: filter_nama
        },
        success: function(results) {
            let data = results.data;

            $.each(data, function(index, item) {
                table.row.add([
                    item.kode,
                    `<a href="/kategori-items/${item.id}">${item.nama}</a>`
                ]);
            });

            table.draw();
        },
        error: function() {
            alert('Terjadi kesalahan server, tidak dapat mengambil data');
        }
    });
}
</script>
@endsection
