@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengguna</li>
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
                        <h3 class="card-title">Data Pengguna</h3>
                        <a href="{{route('tambah-pengguna')}}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Tambah </a>
                    </div>
                    <div class="search-bar">
                      <form class="search-form d-flex align-items-center" method="get" action="{{route('cari-pengguna')}}">
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
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Level</th>
                        <th>Status</th>
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
                              <td>{{$item->username}}</td>
                              <td>{{$item->name}}</td>
                              <td>{{$item->telp == null ? '-' : $item->telp}}</td>
                              <td>{{$item->id == 1 ? 'Super' : ''}} {{ $item->level == 'isAdmin' ? 'Admin' : ($item->level == 'isKasir' ? 'Kasir' : 'Design')}}</td>
                              <td>Akses {{$item->status}}</td>
                              <td class="text-center">
                                @if ($item->id != 1)
                                  <div class="btn-group">
                                    @if ($item->status == 'enable')
                                      <form method="POST" action="{{route('status-pengguna', $item->id)}}">
                                        @csrf
                                        <input type="hidden" name="status" value="disable">
                                        <button type="submit" class="btn btn-sm btn-secondary"><i class="fa fa-ban"></i> Disable</button>
                                      </form>
                                    @else
                                      <form method="POST" action="{{route('status-pengguna', $item->id)}}">
                                        @csrf
                                        <input type="hidden" name="status" value="enable">
                                        <button type="submit" class="btn btn-sm bg-green"><i class="fa fa-check"></i> Enable</button>
                                      </form>
                                    @endif
                                      <a href="{{route('edit-pengguna', ['id'=> $item->id])}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit </a>
                                      <a href="{{ route('hapus-pengguna', $item->id) }}" class="btn btn-sm btn-danger" data-confirm-delete="true"><i class="fa fa-trash"></i> Delete</a>
                                  </div>
                                @endif
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