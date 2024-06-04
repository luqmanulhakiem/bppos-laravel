<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
<table>
    <tr>
        {{-- <td> --}}
            {{-- <img src="{{asset('assets/dist/img/logoo.jpeg')}}" class="img-circle elevation-2" alt="User Image"> --}}
            {{-- <img src="{{url('storage/konfig/member_card.png')}}" class="img-fluid" alt="User Image"> --}}
        {{-- </td> --}}
        <td colspan="3">
            <h2>BINTANG PRINTAMA</h2>
            <p>Digital Printing Center</p>
            <p>Jl. Darma Gg. 1A no.1 Lawangan Daya Pamekasan, No WA : 085233359990, 6285259992877, 6281999600623, 628175160642</p>
        </td>
        <td colspan="2">
            <p>{{$data->created_at}}</p>
            <p>No Pesanan : {{$data->no_nota}}</p>
            <p>Kepada Yth: <br> {{$data->pelanggan->nama}}</p>
        </td>
    </tr>
  <tr>
    <th>No</th>
    <th>Produk</th>
    <th>Qty</th>
    <th>Harga Satuan</th>
    <th>Subtotal Harga</th>
  </tr>
  <?php $num = 1 ?>
  @foreach ($item as $item)
      <tr>
        <td>{{$num}}</td>
        <td>{{$item->nama}}-, 
            @if ($item->ukuran == null)
                {{$item->ukuran_p}} x {{$item->ukuran_l}}
            @else
                {{$item->kuantitas}}
            @endif
        </td>
        <td>{{$item->kuantitas}}</td>
        <td>Rp. {{$item->harga}}</td>
        <td>Rp. {{$item->total}}</td>
      </tr>
  @endforeach
  <tr>
    <td colspan="4">Total Harga</td>
    <td>Rp. 182,000</td>
  </tr>
  <tr>
    <td colspan="4">Diskon</td>
    <td>Rp. 0</td>
  </tr>
  <tr>
    <td colspan="4">Uang Muka</td>
    <td>Rp. 0</td>
  </tr>
  <tr>
    <td colspan="4">HARGA FINAL</td>
    <td>Rp. 182,000</td>
  </tr>
  <tr>
    <td colspan="4">Sisa Bayar</td>
    <td>Rp. 0</td>
  </tr>
  <tr>
    <td colspan="3">
        <p>Syarat dan Ketentuan : <br>
        • Biaya tambahan administrasi pembayaran melalui fitur bank / merchant / PPN, seluruhnya dibebankan kepada pemesan.
        Jika pesanan tidak diambil melebihi 1 minggu dari waktu yang ditetukan, Hilang / Rusak bukan tanggug jawab kami.</p>
    </td>
    <td>
        <p>Hormat Kami</p>
        <br><br><hr>
        <p>Owner</p>
    </td>
    <td>
        <br><br><br><hr>
        <p>Tanda Terima</p>
    </td>
  </tr>
</table>
<p>Terima kasih telah berbelanja dan menggunakan jasa kami.</p>

</body>
</html>