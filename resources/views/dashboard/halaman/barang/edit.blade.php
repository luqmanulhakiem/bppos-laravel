@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Barang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Barang</li>
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
            <h3 class="card-title">Edit Barang</h3>

            <div class="card-tools">
              <a href="{{route('barang')}}" class="btn btn-warning">Kembali</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form method="POST" action="{{route('update-barang', ['id'=>$data->id])}}">
                    @csrf
                    <div class="form-group">
                      <label>Nama Barang<b class="text-danger">*</b></label>
                      <input type="text" class="form-control" name="nama" placeholder="Nama Barang" value="{{$data->nama}}" required>
                    </div>
                    <div class="form-group">
                      <label>Kategori<b class="text-danger">*</b></label>
                      <select name="id_kategori" class="form-control">
                        @foreach ($kategori as $item)
                            <option value="{{$item->id}}" @if ($item->id == $data->id_kategori) {{ 'selected' }} @endif>{{$item->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Satuan<b class="text-danger">*</b></label>
                      <select name="id_satuan" class="form-control">
                        @foreach ($satuan as $item)
                            <option value="{{$item->id}}" @if ($item->id == $data->id_satuan) {{ 'selected' }} @endif>{{$item->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Stok<b class="text-danger">*</b></label>
                      <input type="text" class="form-control" placeholder="stok" name="stok" value="{{$data->stok}}" required>
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