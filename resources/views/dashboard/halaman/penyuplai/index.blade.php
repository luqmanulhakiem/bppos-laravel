@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Penyuplai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Penyuplai</li>
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
                        <h3 class="card-title">Data Penyuplai</h3>
                        <a href="{{route('tambah-penyuplai')}}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Tambah </a>
                    </div>
                    <div class="search-bar">
                      <form class="search-form d-flex align-items-center" method="get" action="{{route('cari-penyuplai')}}">
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
                        <th style="width: 10px">#</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Pilihan</th>
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
                              <td>{{$item->telp}}</td>
                              <td>{{$item->alamat}}</td>
                              <td>{{$item->deskripsi}}</td>
                              <td class="text-center">
                                  <div class="btn-group">
                                      <a href="{{route('edit-penyuplai', ['id'=> $item->id])}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit </a>
                                      <a href="{{route('hapus-penyuplai', ['id'=> $item->id])}}" data-confirm-delete="true" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus </a>
                                  </div>
                              </td>
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