@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              @if (Request::is('rekap-laporan-bulanan/*'))
                Rekap Bulanan
              @else
                Rekap Harian
              @endif
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rekap</li>
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
                    <p class="row">
                      <?php 
                        $date = Carbon\Carbon::parse('2024-06-04');
                        $formattedDate = $date->format('D, d F Y');
                        ?>
                      <div class="">
                        SALDO AKHIR = SALDO AWAL + TOTAL MASUK - TOTAL KELUAR
                      </div>
                      <div class="text-center">{{$formattedDate}}</div>
                    </p>
                  <div class="text-center">
                    <a href="" class="btn btn-primary">Saldo Awal</a>
                    <a href="" class="btn btn-primary">Pengeluaran</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <div class="card">
                    <div class="card-body">
                      <p>Saldo Awal</p>
                      <hr>
                      <h1>Rp. 4000000</h1>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card">
                    <div class="card-body">
                      <p>Saldo Akhir</p>
                      <hr>
                      <h1>Rp. 4000000</h1>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card">
                    <div class="card-body">
                      <p>Total Pemasukan</p>
                      <hr>
                      <h1>Rp. 4000000</h1>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card">
                    <div class="card-body">
                      <p>Total Pengeluaran</p>
                      <hr>
                      <h1>Rp. 4000000</h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                  <div class="row">
                    @if (Request::is('rekap-laporan-harian/*'))
                      <div class="col-md-2">
                        <div class="form-group mr-2">
                          <label for="label">Filter</label>
                              <input type="date" name="tanggal" id="tanggal" value="{{$tanggal}}" class="form-control" />
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                              <label for="">Lihat</label>
                              <a href="" onclick="this.href='/rekap-laporan-harian/'+ document.getElementById('tanggal').value " 
                              class="btn btn-primary col-md-12">
                                  Lihat
                              </a>
                          </div>
                      </div>
                    @endif
    
                    @if (Request::is('rekap-laporan-bulanan/*'))
                      <div class="col-md-2">
                        <label for="month">Bulan:</label>
                        <select class="form-control" name="bulan" id="bulan">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ old('month', $bulan) == $i ? 'selected' : '' }}>
                                  {{ \Carbon\Carbon::create()->locale('id')->month($i)->translatedFormat('F') }}
                                </option>
                            @endfor
                        </select>
                      </div>
                      <div class="col-md-2">
                        <label for="year">Tahun:</label>
                        <select class="form-control" name="tahun" id="tahun">
                            @for ($i = 2020; $i <= \Carbon\Carbon::now()->year; $i++)
                                <option value="{{ $i }}" {{ old('year', $tahun) == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="">Lihat</label>
                          <a onclick="this.href='/rekap-laporan-bulanan/'+ document.getElementById('bulan').value + 
                          '/' + document.getElementById('tahun').value " 
                          class="btn btn-primary col-md-12">
                              Lihat
                          </a>
                      </div>
                      </div>
                    @endif
    
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Waktu</th>
                        <th>Keterangan</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Admin</th>
                        {{-- <th class="text-center">Pilihan</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                      {{-- Inisialisasi Nomer Urut --}}
                      <?php $number = 1 ?>
                      {{-- check data memiliki item lebih besar dari 1 --}}
                      @if (count($data) >= 1)
                        {{-- Looping Data --}}
                        @foreach ($data as $item)
                          <tr>
                            <td>{{$number++}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->keterangan}} {{$item->no_nota}}</td>
                            <td>Rp. {{$item->masuk}}</td>
                            <td>Rp. {{$item->keluar}}</td>
                            <td>{{$item->username}}</td>
                              {{-- <td class="text-center">
                                  <div class="btn-group">
                                      <a href="{{route('hapus-satuan', ['id'=> $item->id])}}" data-confirm-delete="true" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus </a>
                                  </div>
                              </td> --}}
                          </tr>
                        @endforeach
                      @else
                          <tr>
                            <td colspan="6" class="text-center">Belum ada data</td>
                          </tr>
                      @endif
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  {{-- Navigasi Paginasi --}}
                  {{$data->links()}}
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
@endsection