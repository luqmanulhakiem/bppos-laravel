@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Penjualan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Penjualan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <form action="{{route('penjualan.store-selesai.p', ['id' => $penjualan->id])}}" method="POST">
            @csrf
            <div class="row">
              @if ($errors->any())
              <div class="pt-4 pb-2">
                  @foreach ($errors->all() as $error)
                    <p class="text-center small text-red">{{ $error }}</p>
                  @endforeach
                </div>
              @endif
              {{-- Input Pelanggan --}}
              <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Tanggal</label>
                          </div>
                          <div class="col-8">
                            <input type="date" name="tgl_penjualan" value="{{$penjualan->tgl_penjualan}}" id="tglPenjualan" class="form-control" readonly>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Kasir</label>
                          </div>
                          <div class="col-8">
                            <input type="hidden" name="id_kasir" value="{{auth()->user()->id}}">
                            <input type="text" class="form-control" value="{{auth()->user()->name}}" readonly>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Pelanggan</label>
                          </div>
                          <div class="col-8">
                            <div class="input-group">
                                <input type="text" value="{{$penjualan->pelanggan->nama}}" class="form-control" readonly>
                            </div>
                          </div>
                        </div>
                    </div>
                    {{-- <div class="row card-footer">
                      <div class="col-4"></div>
                      <div class="col-8">
                        <button type="button" id="btnTerapkan" class="btn btn-sm btn-primary" disabled>Terapkan</button>
                        <button id="btnReset" type="button" class="btn btn-sm btn-secondary" disabled><i class="fa fa-arrow-left"></i> Reset</button>
                      </div>
                    </div> --}}
                </div>
              </div>
              {{-- Input Barang --}}
              <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Kode Barang</label>
                          </div>
                          <div class="col-8">
                            <div class="input-group">
                              {{-- Validasi --}}
                              <input type="hidden" id="inptIdPenjualan" value="{{$penjualan->id}}">
                              <input type="hidden" id="stok">
                              <input type="hidden" id="stokP">
                              <input type="hidden" id="stokL">
                              {{-- Important --}}
                              <input type="hidden" id="idPelanggan" value="{{$penjualan->pelanggan->id}}">
                              <input type="hidden" name="id_barang" id="inptIdBarang">
                              <input type="hidden" name="harga" id="inptHarga">
                              <input type="text" id="kodeBarang" class="form-control" value="-" readonly>
                              <button id="btnCariBarang" data-toggle="modal" data-target="#modalPilihBarang" class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-4">
                            <label>Ukuran</label>
                            <input type="hidden" id="jenisBarang">
                          </div>
                          <div class="col-8">
                            <input type="text" name="ukuran" id="ukuran" class="form-control" placeholder="" disabled>
                            <div class="row">
                              <div class="form-group col-md">
                                <input type="number" name="ukuran_p" id="ukuran_p" placeholder="P (cm)" class="form-control" hidden>
                              </div>
                              <div class="form-group col-md">
                                <input type="number" name="ukuran_l" id="ukuran_l" placeholder="L (cm)" class="form-control" hidden>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Kuantiti</label>
                          </div>
                          <div class="col-8">
                            <input type="number" class="form-control" name="kuantitas" id="inputQtyBarang" disabled required>
                          </div>
                        </div>
                    </div>
                    <div class="row card-footer">
                      <div class="col-4"></div>
                      <div class="col-8">
                        <button id="btnKeranjang" type="button" class="btn btn-sm btn-primary" disabled><i class="fa fa-shopping-cart"></i> Tambah</button>
                      </div>
                    </div>
                </div>
              </div>
              {{-- Gatau ini Apa --}}
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <input type="hidden" name="no_nota" value="{{$penjualan->no_nota}}">
                      <p class="card-title">
                        Invoice {{$penjualan->no_nota}}
                      </p>
                    </div>
                    <div class="row">
                      <h1 id="grand_total2" class="text-red">{{$penjualan->grand_total}}</h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="card col-md-12">
                <div class="card-body">
                  <table id="cart-table" class="table table-responsive-md table-bordered">
                  <thead>
                      <tr>
                        <th>#</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Ukuran (Cm)</th>
                        <th>Harga</th>
                        <th>Kuantitas</th>
                        <th>Diskon</th>
                        <th>Total</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if (count($keranjang) > 0)
                      <?php $num = 1 ?>
                        @foreach ($keranjang as $item)
                            <tr>
                              <td>{{$num++}}</td>
                              <td>{{$item->kode}}</td>
                              <td>{{$item->nama}}</td>
                              <td>
                                @if ($item->ukuran != null)
                                  {{$item->ukuran}}
                                @else
                                  {{$item->ukuran_p}}  x {{$item->ukuran_l}} 

                                @endif

                              </td>
                              {{-- <td>{{$item->ukuran != null ? $item->ukuran : "$item->ukuran_p" . "x" . $item->ukuran_l}}</td> --}}
                              <td>{{$item->harga}}</td>
                              <td>{{$item->kuantitas}}</td>
                              <td>{{$item->diskon}}</td>
                              <td>{{$item->total}}</td>
                              <td class="text-center">
                                <div class="btn-group">
                                  <a class="btn btn-sm btn-danger" id="btnHapus" data-id="{{$item->id}}" ><i class="fa fa-trash"></i> Hapus</a>
                                </div>
                              </td>
                            </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="9" class="text-center">Tidak ada item</td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.row -->
            <div class="row">
              {{-- Total --}}
              <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Sub Total</label>
                          </div>
                          <div class="col-8">
                            <input type="text" name="sub_total" value="{{$penjualan->sub_total}}" id="sub_total" class="form-control" readonly>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">DP</label>
                          </div>
                          <div class="col-8">
                            <input type="number" id="dp" class="form-control" name="bayar" value="{{$penjualan->bayar}}" readonly>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Grand Total</label>
                          </div>
                          <div class="col-8">
                            <input type="text" id="grand_total" value="{{$penjualan->grand_total}}" name="grand_total" class="form-control bg-orange text-white" readonly>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
              {{-- Input pembayaran --}}
              <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Pengambilan</label>
                          </div>
                          <div class="col-8">
                            <input type="date" name="tgl_pengambilan" value="{{$penjualan->tgl_pengambilan}}" id="" class="form-control" readonly>
                          </div>
                        </div>
                        
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Bayar</label>
                          </div>
                          <div class="col-8">
                            <input type="number" id="bayar" class="form-control" name="bayar" value="0" required>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Sisa</label>
                          </div>
                          <div class="col-8">
                            <input type="text" name="sisa" value="{{(int) $penjualan->grand_total - (int) $penjualan->bayar}}" id="sisa" class="form-control" readonly>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
              {{-- Catatan --}}
              {{-- <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row form-group">
                            <label for="">Catatan (Opsional)</label>
                            <textarea name="catatan" id="" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                </div>
              </div> --}}
              {{-- Submit --}}
              <div class="col-md-3">
                  <div class="row mt-4 mb-3">
                    <button type="button" class="btn btn-secondary">Pembayaran Digital</button>
                  </div>
                  <div class="row">
                    <button type="submit" class="btn btn-primary">Pembayaran Cash</button>
                  </div>
              </div>
            </div>
            <!-- /.row -->
          </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  {{-- Modal Pilih Barang --}}
  <div class="modal fade" id="modalPilihBarang" tabindex="-1" role="dialog" aria-labelledby="modalPilihBarangLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalPilihBarangLabel">Pilih Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row mb-2">
            <input type="text" class="form-control col-md-6" id="searchInput" name="param" placeholder="Cari..." title="Kata Kunci: Masukkan Kata Kunci">
          </div>
          <table id="barang-table" class="table table-bordered">
            <thead>
              <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Pilihan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="5" class="text-center">Belum ada data</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
            {{$barang->links()}}
        </div>
      </div>
    </div>
  </div>
  {{-- Modal Keranjang Selesai --}}
  <div class="modal fade" id="modalKeranjang" tabindex="-1" role="dialog" aria-labelledby="modalKeranjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalKeranjangLabel">Antrian Penjualan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row mb-2">
            {{-- <input type="text" class="form-control col-md-6" id="searchInput" name="param" placeholder="Cari..." title="Kata Kunci: Masukkan Kata Kunci"> --}}
          </div>
          <table id="barang-table" class="table table-bordered table-responsive" style="font-size: 15px !important;">
            <thead>
              <tr>
                <th>Invoice No</th>
                <th>Customer</th>
                <th>Tanggal Masuk</th>
                <th>Pengambilan</th>
                <th>Ket</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              {{-- @if (count($penjualan) > 0) --}}
              {{-- @foreach ($penjualan as $item) --}}
                {{-- <tr>
                  <td>{{$item->no_nota}}</td>
                  <td>{{$item->pelanggan->nama}}</td>
                  <td>{{$item->tgl_penjualan}}</td>
                  <td>{{$item->tgl_pengambilan}}</td>
                  <td><span class="{{$item->sisa < 0 ? 'badge bg-danger' : 'badge bg-green'}}">
                    {{$item->sisa < 0 ? "Kurang " . Illuminate\Support\Number::format(abs(str_replace(',','', $item->sisa))) : "Lunas"}}
                  </span>
                  </td>
                  <td>
                    <div class="btn btn-group">
                      <button class="btn btn-sm btn-secondary"><i class="fa fa-print"></i> Cetak</button>
                      @if ($item->sisa < 0)
                        <a href="{{route('penjualan.store-selesai', ['id' => $item->id])}}" class="btn btn-sm btn-warning"><i class="fa fa-exclamation-triangle "></i> Selesai</a>
                      @else
                        <a href="{{route('penjualan.store-selesai', ['id' => $item->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Selesai</a>
                      @endif
                    </div>
                  </td>
                </tr>
              @endforeach
              @else --}}
                <tr>
                  <td colspan="6" class="text-center">Belum ada data</td>
                </tr>
              {{-- @endif --}}
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
            {{-- {{$penjualan->links()}} --}}
        </div>
      </div>
    </div>
  </div>
  @push('penjualan-edit-script')
  <script>
     $(document).ready(function() {
      var idPelanggan = $('#idPelanggan').val();
      $.ajax({
            url: "{{route('penjualan.list-barang')}}", // Ganti dengan URL endpoint Anda
            type: 'GET', // Ubah metode HTTP sesuai dengan metode yang digunakan pada server Anda
            dataType: 'json',
            data: {
                id_pelanggan: idPelanggan // Ganti dengan id pelanggan yang sesuai
            },
            success: function(response){
              var pelanggan = response.pelanggan;
              var barang = response.barang.data; // Ambil data barang dari pagination
              var table = $('#barang-table');

              // Bersihkan isi tabel sebelum menambahkan data baru
              table.find("tr:gt(0)").remove();
              
              // Loop melalui setiap data barang dan tambahkan ke tabel
              $.each(barang, function(key, value){
                  var harga;
                  if (pelanggan.level == 1)
                  {
                    harga = value.harga.reseller1;
                  } else if(pelanggan.level == 2)
                  {
                    harga = value.harga.reseller2;
                  } else if(pelanggan.level == 3)
                  {
                    harga = value.harga.reseller3;
                  } else if(pelanggan.level == 4)
                  {
                    harga = value.harga.reseller4;
                  } else {
                    harga = value.harga.umum;
                  }
                    var row = '<tr>' +
                                '<td>' + value.kode + '</td>' + // Ganti dengan atribut yang sesuai
                                '<td>' + value.nama + '</td>' + // Ganti dengan atribut yang sesuai
                                '<td>' + value.satuan.nama + '</td>' + // Ganti dengan atribut yang sesuai
                                '<td>' + harga + '</td>' + // Ganti dengan atribut yang sesuai
                                '<td>' + "<button type='button' id='btnPilih' data-stok='" + value.stok + "' data-stokp='" + value.stok_p + "' data-stokl='" + value.stok_l + "' data-barid='" + value.id + "' data-harga='" + harga + "' data-pelid='" + pelanggan.id + "' data-jenis='" + value.jenis + "' data-kode='" + value.kode + "' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Pilih</button>" + '</td>' + // Ganti dengan atribut yang sesuai
                              '</tr>';
                    table.append(row);
                });
            },
            error: function(xhr, status, error){
                console.error(error);
                // Tambahkan penanganan kesalahan di sini jika diperlukan
            }
        });
        $('#bayar').on('change keyup', function() {
          var grandTotal = parseFloat($('#grand_total').val());
          var dp = parseFloat($('#dp').val());
          var bayar = parseFloat($(this).val());
          var sisa = (bayar - grandTotal) + dp;
          $('#sisa').val(sisa);
        });
      });
     $('#modalPilihBarang').on('keyup click', '#searchInput, #btnPilih', function(event) {
      if (event.target.id === 'searchInput') {
          var searchText = $(this).val().toLowerCase();
          var idPelanggan = $('#id_pelanggan').val();
          $.ajax({
            url: "{{route('penjualan.cari-barang')}}", // Ganti dengan URL endpoint Anda
            type: 'GET', // Ubah metode HTTP sesuai dengan metode yang digunakan pada server Anda
            dataType: 'json',
            data: {
                id_pelanggan: idPelanggan, // Ganti dengan id pelanggan yang sesuai
                param: searchText
            },
            success: function(response){
                var pelanggan = response.pelanggan;
                var barang = response.barang.data; // Ambil data barang dari pagination
                var table = $('#barang-table'); // Ganti dengan ID tabel Anda

                // Bersihkan isi tabel sebelum menambahkan data baru
                table.find("tr:gt(0)").remove();

                // Loop melalui setiap data barang dan tambahkan ke tabel
                $.each(barang, function(key, value){
                  var harga;
                  if (pelanggan.level == 1)
                  {
                    harga = value.harga.reseller1;
                  } else if(pelanggan.level == 2)
                  {
                    harga = value.harga.reseller2;
                  } else if(pelanggan.level == 3)
                  {
                    harga = value.harga.reseller3;
                  } else if(pelanggan.level == 4)
                  {
                    harga = value.harga.reseller4;
                  } else {
                    harga = value.harga.umum;
                  }
                    var row = '<tr>' +
                                '<td>' + value.kode + '</td>' + // Ganti dengan atribut yang sesuai
                                '<td>' + value.nama + '</td>' + // Ganti dengan atribut yang sesuai
                                '<td>' + value.satuan.nama + '</td>' + // Ganti dengan atribut yang sesuai
                                '<td>' + harga + '</td>' + // Ganti dengan atribut yang sesuai
                                '<td>' + "<button type='button' id='btnPilih' data-stok='" + value.stok + "' data-stokp='" + value.stok_p + "' data-stokl='" + value.stok_l + "' data-barid='" + value.id + "' data-harga='" + harga + "' data-pelid='" + pelanggan.id + "' data-jenis='" + value.jenis + "' data-kode='" + value.kode + "' class='btn btn-sm btn-primary'><i class='fa fa-check'></i> Pilih</button>" + '</td>' + // Ganti dengan atribut yang sesuai
                              '</tr>';
                    table.append(row);
                    // search get
                });
            },
            error: function(xhr, status, error){
                console.error(error);
                // Tambahkan penanganan kesalahan di sini jika diperlukan
            }
        });
      } else if (event.target.id === 'btnPilih') {
          var harga = $(this).data("harga");
          var kode = $(this).data("kode");
          var idBarang = $(this).data("barid");
          var idPelanggan = $(this).data("pelid");
          var jenis = $(this).data("jenis");
          var stok = $(this).data("stok");
          var stokP = $(this).data("stokp");
          var stokL = $(this).data("stokl");

          $('#jenisBarang').val(jenis);
          $('#stok').val(stok);
          $('#stokP').val(stokP);
          $('#stokL').val(stokL);
          $('#kodeBarang').val(kode);
          $('#inptIdBarang').val(idBarang);
          $('#inptIdPelanggan').val(idPelanggan);
          $('#inptHarga').val(harga);
          $('#btnKeranjang').prop('disabled', false);
          $('#jenisBarang').trigger('change');
          $('#modalPilihBarang').modal('hide'); 
      };
    });
    $('#jenisBarang').on('change', function() {
        var satuanValue = $(this).val();
        if (satuanValue === '1') {
            $('#ukuran').val('Pcs/Unit');
            $('#ukuran').prop('hidden', false).show();
            $('#inputQtyBarang').prop('disabled', false);
            $('#inputQtyBarang').val('1');
            $('#ukuran_p, #ukuran_l').hide().prop('hidden', true);
        } else if (satuanValue === '2') {
            $('#ukuran').prop('hidden', true).hide();
            $('#ukuran_p, #ukuran_l').show().prop('hidden', false);
            $('#inputQtyBarang').prop('disabled', false);
            $('#inputQtyBarang').val('1');
        }
    });
    // add keranjang
  $('#btnKeranjang').on('click', function() {
    var inptIdPenjualan = $('#inptIdPenjualan').val();
    var inptIdBarang = $('#inptIdBarang').val();
    var inptHarga = $('#inptHarga').val();
    var inptKuantitas =  $('#inputQtyBarang').val();
    var inptJenis =  $('#jenisBarang').val();
    var inptUkuranP =  $('#ukuran_p').val();
    var inptUkuranL =  $('#ukuran_l').val();
    var inptData = {};
    var check = 0;
    if (inptJenis == 1) {
      if (inptKuantitas <= 0) {
          alert('angka tidak boleh 0 atau minus');
      } else {
        var stok = $('#stok').val();
        if (parseFloat(inptKuantitas) <= parseFloat(stok)) {
          inptData = {
              jenis: inptJenis,
              id_penjualan: inptIdPenjualan,
              id_barang: inptIdBarang,
              harga: inptHarga,
              kuantitas: inptKuantitas,
          };
          check = 1;
        }else{
          alert( 'stok tidak cukup, stok barang ini tersisa ' + stok);
        }
      }
    }else {
      console.log(inptUkuranP);
      if (inptUkuranP == '') {
        alert('ukuran p tidak boleh kosong');
      }else if (inptUkuranL == '') {
        alert('ukuran l tidak boleh kosong');
      }else if (inptKuantitas == '') {
        alert('kuantiti tidak boleh kosong');
      } else {
        if (inptUkuranP <= 0 || inptUkuranL <= 0 || inptKuantitas <= 0) {
          alert('angka tidak boleh 0 atau minus');
        } else {
          var stokP = parseFloat($('#stokP').val());
          var stokL = parseFloat($('#stokL').val());
          console.log('stok p ' + stokP + ' , stok l ' + stokL);
          console.log('input p ' + inptUkuranP + ' , input l ' + inptUkuranL);

          if (parseFloat(inptUkuranP) <= stokP && parseFloat(inptUkuranL) <= stokL){
            inptData = {
                jenis: inptJenis,
                id_penjualan: inptIdPenjualan,
                id_barang: inptIdBarang,
                ukuran_p: inptUkuranP,
                ukuran_l: inptUkuranL,
                harga: inptHarga,
                kuantitas: inptKuantitas,
              };
            check = 1;
          }else{
            alert( 'stok tidak cukup, stok barang ini tersisa ' + stokP + ' x ' + stokL);
          }
        }
      }

    }
    if (check == 1) {
      $.ajax({
          url: "{{route('penjualan.edit.add')}}", // Ganti dengan URL endpoint Anda
          type: 'POST', // Ubah metode HTTP sesuai dengan metode yang digunakan pada server Anda
          dataType: 'json',
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          data: inptData,
          success: function(response){
              var keranjang = response.data; // Ambil data barang dari pagination
              var table = $('#cart-table'); // Ganti dengan ID tabel Anda
              $('#sub_total').val(response.sub_total);
              $('#diskon').val(0);
              var grandTotal = response.sub_total - (response.sub_total * 0 / 100);
              $('#grand_total').val(grandTotal);
              var bayar = $('#bayar').val();
              $('#sisa').val(bayar - grandTotal);
              $('#grand_total2').text(grandTotal);
              // var sisa = response.sub_total - response.sisa;
              $('#sisa').val(response.sisa);
  
              // Bersihkan isi tabel sebelum menambahkan data baru
              table.find("tr:gt(0)").remove();
  
              // Loop melalui setiap data barang dan tambahkan ke tabel
                var number = 1;
              $.each(keranjang, function(key, value){
                var row = '<tr>' +
                            '<td>' + number++ + '</td>' +
                            '<td>' + value.kode + '</td>' +
                            '<td>' + value.nama + '</td>' +
                            '<td>' + (value.jenis == 1 ? value.ukuran : (value.ukuran_p + 'x' + value.ukuran_l)) + '</td>' +
                            '<td>' + value.harga + '</td>' +
                            '<td>' + value.kuantitas + '</td>' +
                            '<td>' + value.diskon + '</td>' +
                            '<td>' + value.total + '</td>' +
                            '<td>' + "<button type='button' id='btnHapus' data-id='" + value.keranjang_id + "' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Hapus</button>" + '</td>' +
                          '</tr>';
                  table.append(row);
              });
          },
          error: function(xhr, status, error){
              console.error(error);
              // Tambahkan penanganan kesalahan di sini jika diperlukan
          }
      });
      $('#btnCariBarang').prop('disabled', false).removeClass('btn-secondary').addClass('btn-primary');
      $('#kodeBarang').val('-');
      $('#ukuran_p, #ukuran_l').hide().prop('hidden', true);
      $('#inputQtyBarang').prop('disabled', true);
      $('#inputQtyBarang').val('');
      $('#ukuran').prop('disabled', true);
      $('#ukuran').val('');
      $('#btnKeranjang').prop('disabled', true);
      $('#ukuran').prop('hidden', false).show();
    }
    
  });
  //hapus item
  $(document).on('click', '#btnHapus', function() {
    console.log('aaa');
    var id = $(this).data("id");
    var idPelanggan = $('#inptIdPenjualan').val();

    var data = {
      id: id,
      id_penjualan: idPelanggan
    };

    hapusKeranjang(data);

    console.log("Hapus Item" + id + "IdPelanggan" + idPelanggan);
  });
  function hapusKeranjang(inptData) {
    $.ajax({
        url: "{{route('penjualan.edit.delete')}}",
        type: 'POST',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: inptData,
        success: function(response){
            var keranjang = response.data; 
            var table = $('#cart-table');
            table.find("tr:gt(0)").remove();
        
            if (keranjang.length === 0) {
              var row = '<tr>' +
                          '<td colspan="9" class="text-center">Tidak Ada Item</td>' +
                        '</tr>';
              table.append(row);
              $('#sub_total').val(response.sub_total);
              $('#diskon').val(0);
              var grandTotal = response.sub_total - (response.sub_total * 0 / 100);
              $('#grand_total').val(grandTotal);
              
              $('#grand_total2').text(grandTotal);
            }else {
              $('#sub_total').val(response.sub_total);
              $('#diskon').val(0);
              var grandTotal = response.sub_total - (response.sub_total * 0 / 100);
              $('#grand_total').val(grandTotal);
              var bayar = $('#bayar').val();
              $('#sisa').val(bayar - grandTotal);
              $('#grand_total2').text(grandTotal);

              var number = 1;
              $.each(keranjang, function(key, value){
                  var row = '<tr>' +
                              '<td>' + number++ + '</td>' +
                              '<td>' + value.kode + '</td>' +
                              '<td>' + value.nama + '</td>' +
                              '<td>' + (value.jenis == 1 ? value.ukuran : (value.ukuran_p + 'x' + value.ukuran_l)) + '</td>' +
                              '<td>' + value.harga + '</td>' +
                              '<td>' + value.kuantitas + '</td>' +
                              '<td>' + value.diskon + '</td>' +
                              '<td>' + value.total + '</td>' +
                              '<td>' + "<button type='button' id='btnHapus' data-id='" + value.keranjang_id + "' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Hapus</button>" + '</td>' + // Ganti dengan atribut yang sesuai
                            '</tr>';
                  table.append(row);
                });
            }
        },
        error: function(xhr, status, error){
            console.error(error);
        }
    });
  }
  </script>
  @endpush
@endsection