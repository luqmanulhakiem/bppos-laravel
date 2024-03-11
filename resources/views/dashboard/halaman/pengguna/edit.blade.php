@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Pengguna</li>
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
            <h3 class="card-title">Edit Pengguna</h3>

            <div class="card-tools">
              <div class="button-group">
                <a href="{{route('ganti.password-pengguna', $data->id)}}" class="btn btn-primary"><i class="fa fa-pen"></i> Ganti Password</a>
                <a href="/pengguna" class="btn btn-warning">Kembali</a>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form method="POST" action="{{route('update-pengguna', ['id'=>$data->id])}}">
                    @csrf
                    <div class="form-group">
                      <label>Username<b class="text-danger">*</b></label>
                      <input type="text" class="form-control" name="username" placeholder="Username Pengguna" value="{{$data->username}}" required>
                    </div>
                    <div class="form-group">
                      <label>Nama Pengguna<b class="text-danger">*</b></label>
                      <input type="text" class="form-control" name="name" placeholder="Nama Pengguna" value="{{$data->name}}" required>
                    </div>
                    <div class="form-group">
                      <label>Telpon<b class="text-danger">*</b></label>
                      <input type="text" class="form-control" name="telp" placeholder="Telpon" value="{{$data->telp}}" required>
                    </div>
                    <div class="form-group">
                      <label>Level<b class="text-danger">*</b></label>
                      <select class="form-control select2" style="width: 100%;" name="level" required>
                        <option value="">Pilih Level</option>
                        <option value="isAdmin" @if ($data->level == "isAdmin") {{ 'selected' }} @endif>Admin</option>
                        <option value="isKasir" @if ($data->level == "isKasir") {{ 'selected' }} @endif>Kasir</option>
                        <option value="isDesign" @if ($data->level == "isDesign") {{ 'selected' }} @endif>Design</option>
                      </select>
                    </div>
                    <br>
                    <button class="btn btn-submit btn-primary float-right"><i class="fa fa-save"></i> Simpan</button>
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
@endsection