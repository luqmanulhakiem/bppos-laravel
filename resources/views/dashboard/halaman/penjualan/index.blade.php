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
            <div class="row">
              {{-- Input Pelanggan --}}
              <div class="col-md-4">
                <div class="card">
                  <form method="POST" action="{{route('konfigurasi.update')}}">
                    @csrf
                    <div class="card-body">
                        {{-- @if ($errors->any())
                          <div class="pt-4 pb-2">
                            @foreach ($errors->all() as $error)
                              <p class="text-center small text-red">{{ $error }}</p>
                            @endforeach
                          </div>
                        @endif --}}
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Tanggal</label>
                          </div>
                          <div class="col-8">
                            <input type="date" name="" id="" class="form-control">
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
                              <input type="hidden" name="id_pelanggan" value="">
                              <input type="text" class="form-control" value="Belum Dipilih" readonly>
                              <button class="btn btn-dark" type="button"><i class="fa fa-qrcode"></i></button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="row card-footer">
                      <div class="col-4"></div>
                      <div class="col-8">
                        <button class="btn btn-sm btn-primary">Terapkan</button>
                        <button class="btn btn-sm btn-secondary" disabled>Reset</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              {{-- Input Barang --}}
              <div class="col-md-4">
                <div class="card">
                  <form method="POST" action="{{route('konfigurasi.update')}}">
                    @csrf
                    <div class="card-body">
                        {{-- @if ($errors->any())
                          <div class="pt-4 pb-2">
                            @foreach ($errors->all() as $error)
                              <p class="text-center small text-red">{{ $error }}</p>
                            @endforeach
                          </div>
                        @endif --}}
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Kode Barang</label>
                          </div>
                          <div class="col-8">
                            <div class="input-group">
                              <input type="hidden" name="id_barang" value="">
                              <input type="text" class="form-control" value="Belum Dipilih" readonly>
                              <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Ukuran</label>
                          </div>
                          <div class="col-8">
                            <input type="text" class="form-control" value="-" readonly>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Kuantiti</label>
                          </div>
                          <div class="col-8">
                            <input type="number" class="form-control" name="kuantiti" id="">
                          </div>
                        </div>
                    </div>
                    <div class="row card-footer">
                      <div class="col-4"></div>
                      <div class="col-8">
                        <button class="btn btn-sm btn-primary" disabled><i class="fa fa-shopping-cart"></i> Tambah</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              {{-- Gatau ini Apa --}}
              <div class="col-md-4">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <p class="card-title">
                        Invoice BP1201201
                      </p>
                    </div>
                    <div class="row">
                      <h1 class="text-red">0</h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="card col-md-12">
                <div class="card-body">
                  <table class="table table-responsive-md table-bordered">
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
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td colspan="9" class="text-center">Tidak ada item</td>
                      </tr>
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
                  <form method="POST" action="{{route('konfigurasi.update')}}">
                    @csrf
                    <div class="card-body">
                        {{-- @if ($errors->any())
                          <div class="pt-4 pb-2">
                            @foreach ($errors->all() as $error)
                              <p class="text-center small text-red">{{ $error }}</p>
                            @endforeach
                          </div>
                        @endif --}}
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Sub Total</label>
                          </div>
                          <div class="col-8">
                            <input type="text" name="sub_total" class="form-control" disabled>
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Diskon</label>
                          </div>
                          <div class="col-8">
                            <input type="number" class="form-control" name="diskon_sub">
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Grand Total</label>
                          </div>
                          <div class="col-8">
                            <input type="text" name="grand_total" class="form-control" value="A" disabled>
                          </div>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
              {{-- Input pembayaran --}}
              <div class="col-md-3">
                <div class="card">
                  <form method="POST" action="{{route('konfigurasi.update')}}">
                    @csrf
                    <div class="card-body">
                        {{-- @if ($errors->any())
                          <div class="pt-4 pb-2">
                            @foreach ($errors->all() as $error)
                              <p class="text-center small text-red">{{ $error }}</p>
                            @endforeach
                          </div>
                        @endif --}}
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Pengambilan</label>
                          </div>
                          <div class="col-8">
                            <input type="date" name="tgl_ambil" id="" class="form-control">
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Bayar</label>
                          </div>
                          <div class="col-8">
                            <input type="number" class="form-control" name="bayar">
                          </div>
                        </div>
                        <div class="row form-group">
                          <div class="col-4">
                            <label for="">Sisa</label>
                          </div>
                          <div class="col-8">
                            <input type="text" name="sisa" class="form-control" value="0" readonly>
                          </div>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
              {{-- Catatan --}}
              <div class="col-md-3">
                <div class="card">
                  <form method="POST" action="{{route('konfigurasi.update')}}">
                    @csrf
                    <div class="card-body">
                        {{-- @if ($errors->any())
                          <div class="pt-4 pb-2">
                            @foreach ($errors->all() as $error)
                              <p class="text-center small text-red">{{ $error }}</p>
                            @endforeach
                          </div>
                        @endif --}}
                        <div class="row form-group">
                            <label for="">Catatan (Opsional)</label>
                            <textarea name="catatan" id="" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
              {{-- Submit --}}
              <div class="col-md-3">
                <form method="POST" action="{{route('konfigurasi.update')}}">
                  @csrf
                  {{-- @if ($errors->any())
                    <div class="pt-4 pb-2">
                      @foreach ($errors->all() as $error)
                        <p class="text-center small text-red">{{ $error }}</p>
                      @endforeach
                    </div>
                  @endif --}}
                  <div class="row mt-4 mb-3">
                    <button class="btn btn-secondary">Batal</button>
                  </div>
                  <div class="row">
                    <button class="btn btn-primary">Proses Pembayaran</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection