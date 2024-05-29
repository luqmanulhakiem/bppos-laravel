@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Penjualan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Detail Penjualan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-6">
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
                      </table>
                    </div>
                    <div class="col-md-6">
                      <table class="table">
                        <tr>
                          <th>Tanggal Penjualan:</th>
                          <td>{{$data->tgl_penjualan}}</td>
                        </tr>
                        <tr>
                          <th>Tanggal Pengambilan:</th>
                          <td>{{$data->tgl_pengambilan}}</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Ukuran</th>
                        <th>Harga</th>
                        <th>Kuantitas</th>
                        </tr>
                    </thead>
                    <tbody>
                      {{-- Inisialisasi Nomer Urut --}}
                      <?php $number = 1 ?>
                      {{-- check data memiliki item lebih besar dari 1 --}}
                      @if (count($item) >= 1)
                        {{-- Looping Data --}}
                        @foreach ($item as $item)
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
                      @else
                          <tr>
                            <td colspan="8" class="text-center">Belum ada data</td>
                          </tr>
                      @endif
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  {{-- Navigasi Paginasi --}}
                  {{-- {{$data->links()}} --}}
                </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <div class="modal fade" id="detailBarangModal" tabindex="-1" aria-labelledby="detailBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailBarangModalLabel">Detail Laporan Barang Masuk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Tempat untuk menampilkan detail barang -->
          <div id="detailBarangContainer">
            <table class="table table-bordered">
                <tr>
                  <th  class="col-4">Kode</th>
                  <td id="detailKode"></td>
                </tr>
                <tr>
                  <th  class="col-4">Nama Barang</th>
                  <td id="detailNama"></td>
                </tr>
                <tr>
                  <th  class="col-4">Detail</th>
                  <td id="detailInfo"></td>
                </tr>
                <tr>
                  <th  class="col-4">Penyuplai</th>
                  <td id="detailPenyuplai"></td>
                </tr>
                <tr>
                  <th  class="col-4">Ukuran</th>
                  <td id="detailUkuran"></td>
                </tr>
                <tr>
                  <th  class="col-4">Kuantitas</th>
                  <td id="detailKuantitas"></td>
                </tr>
                <tr>
                  <th  class="col-4">Tanggal</th>
                  <td id="detailTanggal"></td>
                </tr>
                <tr>
                  <th  class="col-4">User</th>
                  <td id="detailUser"></td>
                </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@push('barang-script')
<script>
    $(document).ready(function() {
      $('#detailBarangModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Tombol yang ditekan
        var id = button.data('barang-id');

        // Lakukan permintaan AJAX untuk mengambil detail barang berdasarkan ID
        $.ajax({
          url: "{{ route("detail-barang-in-out", ['id' => ':id']) }}".replace(':id', id), // Ganti route sesuai dengan route Anda
          type: 'GET',
          data: {
            id: id
          },
          success: function(response) {
            // Tampilkan detail barang dalam modal
            $('#detailKode').text(response.barang.kode);
            $('#detailNama').text(response.barang.nama);
            $('#detailInfo').text(response.keterangan);
            $('#detailPenyuplai').text(response.penyuplai.nama);
            if (response.ukuran == null) {
              var ukuran = response.ukuran_p + " x " + response.ukuran_l;
              $('#detailUkuran').text(ukuran);
            } else {
              $('#detailUkuran').text(response.ukuran);
            }
            $('#detailKuantitas').text(response.kuantiti);
            $('#detailTanggal').text(response.tanggal);
            $('#detailUser').text(response.user.name);

          },
          error: function(xhr) {
            // Tangani kesalahan jika permintaan gagal
            console.log(xhr.responseText);
          }
        });
      });
    }); 
</script>
@endpush
@endsection