@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Pengeluaran {{$tanggal}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Pengeluaran</li>
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
            <h3 class="card-title">Edit Pengeluaran</h3>
{{-- 
            <div class="card-tools">
              <a href="{{route('satuan')}}" class="btn btn-warning">Kembali</a>
            </div> --}}
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form method="POST" action="{{route('saldo.harian.update.pengeluaran', ['tanggal' => $tanggal])}}">
                    @csrf
                    <div class="form-group">
                      <label>Nominal Pengeluaran<b class="text-danger">*</b></label>
                      <input type="number" class="form-control" name="pengeluaran" placeholder="Nominal" required>
                    </div>
                    <div class="form-group">
                      <label>Keterangan<b class="text-danger">*</b></label>
                      <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" required>
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