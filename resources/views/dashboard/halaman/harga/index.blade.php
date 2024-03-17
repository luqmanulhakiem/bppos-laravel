@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Harga</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Harga</li>
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
                    <div class="row justify-content-between">
                        <h3 class="card-title">Data Harga</h3>
                    </div>
                    <div class="search-bar mt-2">
                      <form class="search-form d-flex align-items-center" method="get" action="{{route('cari-harga')}}">
                        <input type="text" class="form-control col-md-2" name="param" placeholder="Cari..." title="Kata Kunci: Masukkan Kata Kunci">
                        <button type="submit" title="Search" class="btn btn-primary btn-sm"> <i class="fa fa-search"></i> </button>
                      </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th style="width: 10px" rowspan="2">#</th>
                        <th rowspan="2">Nama Barang</th>
                        <th rowspan="2">Kategori</th>
                        <th colspan="7" class="text-center">Harga</th>
                        <tr class="text-center">
                          <th >Umum</th>
                          <th >Rsllr1</th>
                          <th >Rsllr2</th>
                          <th >Rsllr3</th>
                          <th >Rsllr4</th>
                          <th class="text-center">Pilihan</th>
                        </tr>

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
                              <td>{{$item->nama}}</td>
                              <td>{{$item->kategori->nama}}</td>
                              <td>{{Illuminate\Support\Number::format($item->harga->umum)}}</td>
                              <td>{{Illuminate\Support\Number::format($item->harga->reseller1)}}</td>
                              <td>{{Illuminate\Support\Number::format($item->harga->reseller2)}}</td>
                              <td>{{Illuminate\Support\Number::format($item->harga->reseller3)}}</td>
                              <td>{{Illuminate\Support\Number::format($item->harga->reseller4)}}</td>
                              <td class="text-center">
                                  <div class="btn-group">
                                      <a href="{{route('edit-harga', ['id'=> $item->id_harga])}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit </a>
                                  </div>
                              </td>
                          </tr>
                        @endforeach
                      @else
                          <tr>
                            <td colspan="10" class="text-center">Belum ada data</td>
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