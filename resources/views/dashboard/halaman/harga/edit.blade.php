@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Harga</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Harga</li>
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
            <h3 class="card-title">Edit Harga</h3>

            <div class="card-tools">
              <a href="{{route('harga')}}" class="btn btn-warning">Kembali</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form method="POST" action="{{route('update-harga', ['id'=>$data->id_harga])}}">
                    @csrf
                    <div class="d-flex">
                      <div class="form-group col-md-6">
                        <label>Nama Barang<b class="text-danger">*</b></label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Barang" value="{{$data->nama}}" readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Kategori<b class="text-danger">*</b></label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Barang" value="{{$data->kategori->nama}}" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Harga Umum<b class="text-danger">*</b></label>
                      <input type="number" class="form-control" name="umum" placeholder="harga umum" value="{{$data->harga->umum}}" required>
                    </div>
                    <div class="form-group">
                      <label>Harga Reseller 1<b class="text-danger">*</b></label>
                      <input type="number" class="form-control" name="reseller1" placeholder="harga Reseller 1" value="{{$data->harga->reseller1}}" required>
                    </div>
                    <div class="form-group">
                      <label>Harga Reseller 2<b class="text-danger">*</b></label>
                      <input type="number" class="form-control" name="reseller2" placeholder="harga Reseller 2" value="{{$data->harga->reseller2}}" required>
                    </div>
                    <div class="form-group">
                      <label>Harga Reseller 3<b class="text-danger">*</b></label>
                      <input type="number" class="form-control" name="reseller3" placeholder="harga Reseller 3" value="{{$data->harga->reseller3}}" required>
                    </div>
                    <div class="form-group">
                      <label>Harga Reseller 4<b class="text-danger">*</b></label>
                      <input type="number" class="form-control" name="reseller4" placeholder="harga Reseller 4" value="{{$data->harga->reseller4}}" required>
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