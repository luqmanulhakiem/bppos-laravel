@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Barang Keluar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Barang Keluar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Tambah Barang Keluar</h3>

            <div class="card-tools">
              <a href="{{route('barang-keluar')}}" class="btn btn-warning">Kembali</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-md-4">
                <form method="POST" action="{{route('simpan-barang-keluar')}}">
                    @csrf
                    <div class="form-group">
                      <label>Tanggal<b class="text-danger">*</b></label>
                      <input type="date" class="form-control" name="tanggal" id="" required>
                    </div>
                    <div class="form-group">
                      <label>Kode Barang<b class="text-danger">*</b></label>
                      <div class="input-hidden">
                        <input type="hidden" name="id_barang" id="idBarang">
                        <input type="hidden" name="idJenis" id="jenisBarang">
                      </div>
                      <div class="input-group">
                        <input type="text" class="form-control" id="kodeBarang">
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalPilihBarang" id="searchModal" type="button"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Nama Barang<b class="text-danger">*</b></label>
                      <input type="text" id="namaBarang" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                      <label>Kategori<b class="text-danger">*</b></label>
                      <input type="text" id="kategori" class="form-control" readonly>
                    </div>
                    <div class="input-group row">
                      <div class="form-group col-md">
                        <label>Satuan<b class="text-danger">*</b></label>
                        <input type="text" id="satuan" class="form-control" readonly>
                      </div>
                      <div class="form-group col-md">
                        <label>Stok<b class="text-danger">*</b></label>
                        <input type="text" id="stok" class="form-control" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Detail(Opsional)</label>
                      <input type="text" class="form-control" name="keterangan">
                    </div>
                    <div class="form-group">
                      <label>Penyuplai<b class="text-danger">*</b></label>
                      <select name="id_penyuplai" class="form-control">
                        @foreach ($penyuplai as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Ukuran<b class="text-danger">*</b></label>
                      <input type="text" name="ukuran" id="ukuran" class="form-control" readonly>
                      <div class="row">
                        <div class="form-group col-md">
                          <input type="text" name="ukuran_p" id="ukuran_p" placeholder="P (cm)" class="form-control" hidden>
                        </div>
                        <div class="form-group col-md">
                          <input type="text" name="ukuran_l" id="ukuran_l" placeholder="L (cm)" class="form-control" hidden>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Kuantiti<b class="text-danger">*</b></label>
                      <input type="text" class="form-control" name="kuantiti">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-submit btn-primary float-right"><i class="fa fa-save"></i> Simpan</button>
                </form>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  {{-- Modal --}}
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
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Satuan</th>
                <th>Pilihan</th>
              </tr>
            </thead>
            <tbody>
               {{-- Inisialisasi Nomer Urut --}}
               <?php $number = 1 ?>
               {{-- check data memiliki item lebih besar dari 1 --}}
               @if (count($barang) >= 1)
                @foreach ($barang as $item)
                <tr>
                  <td>{{$item->kode}}</td>
                  <td>{{$item->nama}}</td>
                  <td>{{$item->kategori->nama}}</td>
                  <td>{{$item->satuan->nama}}</td>
                  <td><button type="button" id="btnPilih" class="btn btn-sm btn-primary" data-jenis="{{$item->jenis}}" data-id="{{$item->id}}" data-kode="{{$item->kode}}" data-nama="{{$item->nama}}" data-stok="{{$item->stok}}" data-kategori="{{$item->kategori->nama}}" data-satuan="{{$item->satuan->nama}}"><i class="fa fa-check"></i> Pilih</button></td>
                </tr>
                @endforeach                 
               @else
                <tr>
                  <td colspan="5" class="text-center">Belum ada data</td>
                </tr>
               @endif
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
            {{$barang->links()}}
        </div>
      </div>
    </div>
  </div>
@push('barang-script')
<script>
  $(document).ready(function(){
    $('#jenisBarang').on('change', function() {
      var satuanValue = $(this).val();

      if (satuanValue === '1') {
          $('#ukuran').prop('hidden', false).show();
          $('#ukuran').val("Pcs/Unit");
          $('#ukuran_p, #ukuran_l').hide().prop('hidden', true);
      } else if (satuanValue === '2') {
          $('#ukuran').prop('hidden', true).hide();
          $('#ukuran_p, #ukuran_l').show().prop('hidden', false);
      }
  });
    $('#modalPilihBarang').on('keyup click', '#searchInput, #btnPilih', function(event) {
      if (event.target.id === 'searchInput') {
          var searchText = $(this).val().toLowerCase();
          $.ajax({
              url: "{{ route('tambah-barang-masuk.cari') }}",
              method: "GET",
              data: {param: searchText},
              success: function(response){
                  $('#modalPilihBarang tbody').html(response);
              }
          });
      } else if (event.target.id === 'btnPilih') {
          var nama = $(this).data("nama");
          var kode = $(this).data("kode");
          var id = $(this).data("id");
          var jenis = $(this).data("jenis");
          var kategori = $(this).data("kategori");
          var satuan = $(this).data("satuan");
          var stok = $(this).data("stok");

          $('#idBarang').val(id);
          $('#jenisBarang').val(jenis);
          $('#kodeBarang').val(kode);
          $('#namaBarang').val(nama);
          $('#kategori').val(kategori);
          $('#satuan').val(satuan);
          $('#stok').val(stok);
          $('#jenisBarang').trigger('change');
          $('#modalPilihBarang').modal('hide'); 
      };
    });
  });
</script>
@endpush
@endsection