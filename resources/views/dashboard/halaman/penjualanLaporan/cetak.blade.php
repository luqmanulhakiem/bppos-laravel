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
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Invoice No.</th>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Diskon</th>
                <th>Grand Total</th>
			</tr>
		</thead>
		<tbody>
            <?php $number = 1 ?>
			@foreach($data as $item)
                <tr>
                    <td>{{$number++}}</td>
                    <td>{{$item->no_nota}}</td>
                    <td>{{$item->tgl_penjualan}}</td>
                    <td>{{$item->pelanggan->nama}}</td>
                    <td>Rp. {{Illuminate\Support\Number::format($item->sub_total)}}</td>
                    <td>{{$item->diskon}}%</td>
                    <td>Rp. {{Illuminate\Support\Number::format($item->grand_total)}}</td>
                </tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>
