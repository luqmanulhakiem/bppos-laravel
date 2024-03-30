@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengaturan Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header bg-primary">
                    Profil
                  </div>
                  <form action="">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                          <label for="">Nama Lengkap:</label>
                          <input type="text" placeholder="nama lengkap" name="name" value="{{$data->name}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="">Telp:</label>
                          <input type="text" placeholder="no telp" name="telp" value="{{$data->telp}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="card-footer">
                      <button class="btn btn-sm btn-primary">Simpan Profil</button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header bg-orange">
                    <p class="text-white m-0">Akun</p>
                  </div>
                  <form action="">
                    @csrf
                  <div class="card-body">
                      <div class="form-group">
                        <label for="">Username:</label>
                        <input type="text" placeholder="username" name="username" value="{{$data->username}}" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="">Password Saat ini:</label>
                        <input type="password" placeholder="password" name="currentPassword" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="">Password Baru:</label>
                        <input type="password" placeholder="password" name="newPassword" class="form-control" required>
                      </div>
                    </div>
                  <div class="card-footer">
                    <button class="btn btn-sm bg-orange">
                      <p class="text-white m-0">Update Akun</p>
                    </button>
                  </div>
                  </form>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header bg-green">
                    <p class="text-white m-0">Foto Profil</p>
                  </div>
                  <form action="">
                    @csrf
                  <div class="card-body">
                      <div class="form-group">
                        <input type="file" required>
                      </div>
                    </div>
                  <div class="card-footer">
                    <button class="btn btn-sm bg-green">
                      <p class="text-white m-0">Update Foto</p>
                    </button>
                  </div>
                  </form>
                </div>
              </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection