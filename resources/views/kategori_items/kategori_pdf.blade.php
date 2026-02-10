<link rel="stylesheet" href="{{ public_path('libs/bootstrap/css/bootstrap.min.css') }}">

<div class="container">
		<center>
			<h4>Kategori</h4>
		</center>
		<br/>

        <h4>Kategori : {{$kategori->nama}}</h4>
        <h4>Kode : {{$kategori->kode}}</h4>
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Kode</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($kategori->masterItems as $item)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{$item->nama}}</td>
					<td>{{$item->kode}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
 
	</div>