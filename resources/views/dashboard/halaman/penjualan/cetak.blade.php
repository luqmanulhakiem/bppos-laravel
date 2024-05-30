<!DOCTYPE html>
<html>
<head>
	<title> Laporan Penjualan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Penjualan</h4>
	</center>

	<table class="table">
		<tr>
		  <th>No Nota:</th>
		  <td>{{$data->no_nota}}</td>
		</tr>
		<tr>
		  <th>Nama Pelanggan:</th>
		  <td>{{$data->pelanggan->nama}}</td>
		</tr>
		<tr>
		  <th>Grand Total:</th>
		  <td>{{$data->grand_total}}</td>
		</tr>
		<tr>
			<th>Tanggal Penjualan:</th>
			<td>{{$data->tgl_penjualan}}</td>
		  </tr>
		  <tr>
			<th>Tanggal Pengambilan:</th>
			<td>{{$data->tgl_pengambilan}}</td>
		  </tr>
	  </table>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Barang</th>
				<th>Nama Barang</th>
				<th>Ukuran</th>
				<th>Harga</th>
				<th>Kuantitas</th>
			</tr>
		</thead>
		<tbody>
            <?php $number = 1 ?>
			@foreach($item as $item)
                <tr>
                    <td>{{$number++}}</td>
                    <td>{{$item->kode}}</td>
                    <td>{{$item->nama}}</td>
					<td>
						@if ($item->ukuran == null)
						{{$item->ukuran_p}} x {{$item->ukuran_l}}
						@else
						{{$item->ukuran}}
						@endif
					</td>
					<td>Rp. {{Illuminate\Support\Number::format($item->harga)}}</td>
					<td>{{$item->kuantitas}}</td>
                </tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>
