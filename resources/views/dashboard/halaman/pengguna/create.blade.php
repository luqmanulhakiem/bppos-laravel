@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Pengguna</li>
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
            <h3 class="card-title">Tambah Pengguna</h3>

            <div class="card-tools">
              <a href="/pengguna" class="btn btn-warning">Kembali</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form method="POST" action="{{route('simpan-pengguna')}}">
                    @csrf
                    <div class="form-group">
                      <label>Username<b class="text-danger">*</b></label>
                      <input type="text" class="form-control" name="username" placeholder="Username Pengguna" required>
                    </div>
                    <div class="form-group">
                      <label>Nama Pengguna<b class="text-danger">*</b></label>
                      <input type="text" class="form-control" name="name" placeholder="Nama Pengguna" required>
                    </div>
                    <div class="form-group">
                      <label>Password<b class="text-danger">*</b></label>
                      <input type="password" class="form-control" name="password" placeholder="Pasword Minimal 8 Karakter" required>
                    </div>
                    <div class="form-group">
                      <label>Telpon<b class="text-danger">*</b></label>
                      <input type="text" class="form-control" name="telp" placeholder="Telpon" required>
                    </div>
                    <div class="form-group">
                      <label>Level<b class="text-danger">*</b></label>
                      <select class="form-control select2" style="width: 100%;" name="level" required>
                        <option value="isAdmin">Admin</option>
                        <option value="isKasir">Kasir</option>
                        <option value="isDesign" >Design</option>
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