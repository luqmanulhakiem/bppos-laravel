@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pelanggan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pelanggan</li>
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
                        <h3 class="card-title">Data Pelanggan</h3>
                        <a href="{{route('tambah-pelanggan')}}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Tambah </a>
                    </div>
                    <div class="search-bar">
                      <form class="search-form d-flex align-items-center" method="get" action="{{route('cari-pelanggan')}}">
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
                        <th>Gender</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Level</th>
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
                              <td>{{ $item->gender == 'L' ? 'Laki-Laki' : 'Perempuan'}}</td>
                              <td>{{$item->telp}}</td>
                              <td>{{$item->alamat}}</td>
                              <td>Reseller {{$item->level}}</td>
                              <td class="text-center">
                                  <div class="btn-group">
                                      <a href="{{route('edit-pelanggan', ['id'=> $item->id])}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit </a>
                                      <a href="{{ route('alert-pelanggan', ['id' => $item->id]) }}" class="btn btn-danger">Hapus</a>
                                      <a href="{{ route('alert-pelanggan', $item->id) }}" class="btn btn-danger" data-confirm-delete="true">Delete</a>

                                      {{-- <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmDeleteModal"><i class="fa fa-trash"></i> Hapus</button> --}}
                                        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus {{$item->nama}} {{$item->id}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus item ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="{{ route('hapus-pelanggan', ['id' => $item->id]) }}" class="btn btn-danger">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                              </td>
                          </tr>
                        @endforeach
                      @else
                          <tr>
                            <td colspan="7" class="text-center">Belum ada data</td>
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