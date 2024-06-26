@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Pelanggan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Pelanggan</li>
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
            <h3 class="card-title">Tambah Pelanggan</h3>

            <div class="card-tools">
              <a href="/pelanggan" class="btn btn-warning">Kembali</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form method="POST" action="{{route('simpan-pelanggan')}}">
                    @csrf
                    <div class="form-group">
                      <label>Nama Pelanggan<b class="text-danger">*</b></label>
                      <input type="text" class="form-control" name="nama" placeholder="Nama Pelanggan" required>
                    </div>
                    <div class="form-group">
                      <label>Jenis Kelamin<b class="text-danger">*</b></label>
                      <select class="form-control select2" style="width: 100%;" name="gender" required>
                        <option value="L">Laki - Laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Telp<b class="text-danger">*</b></label>
                      <input type="text" class="form-control" name="telp" placeholder="Telp" required>
                    </div>
                    <div class="form-group">
                      <label>Alamat<b class="text-danger">*</b></label>
                      <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
                    </div>
                    <div class="form-group">
                      <label>Level<b class="text-danger">*</b></label>
                      <select class="form-control select2" style="width: 100%;" name="level" required>
                        <option value="0">Umum</option>
                        <option value="1">Reseller 1</option>
                        <option value="2">Reseller 2</option>
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