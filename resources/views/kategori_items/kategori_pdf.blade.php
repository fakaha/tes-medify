<div class="container">
		<center>
			<h4>Kategori</h4>
		</center>
		<br/>
		<a href="/kategori-items/cetak_pdf" class="btn btn-primary" target="_blank">CETAK PDF</a>
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Kode</th>
                    <th>Item</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($kategori as $p)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{$p->nama}}</td>
					<td>{{$p->kode}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
 
	</div>