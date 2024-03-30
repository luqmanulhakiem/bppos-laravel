@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengaturan Aplikasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Konfigurasi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header bg-primary">
                    Profil
                  </div>
                  <form method="POST" action="{{route('profile.update')}}">
                    @csrf
                    <div class="card-body">
                        @if ($errors->any())
                          <div class="pt-4 pb-2">
                            @foreach ($errors->all() as $error)
                              <p class="text-center small text-red">{{ $error }}</p>
                            @endforeach
                          </div>
                        @endif
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Nama Perusahaan:</label>
                              <input type="text" placeholder="nama Lengkap" name="nama_lengkap" value="{{$data->nama_lengkap}}" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="">Kabupaten/Kota:</label>
                              <input type="text" placeholder="kabupaten" name="kabupaten" value="{{$data->kabupaten}}" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="">Whatsapp:</label>
                              <input type="text" placeholder="whatsapp" name="whatsapp" value="{{$data->whatsapp}}" class="form-control" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="">Nama Singkatan:</label>
                              <input type="text" placeholder="nama_singkat" name="nama_singkat" value="{{$data->nama_singkat}}" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="">Fax / Telphone :</label>
                              <input type="text" placeholder="no telp" name="telp" value="{{$data->telp}}" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="">Email:</label>
                              <input type="text" placeholder="Email" name="email" value="{{$data->email}}" class="form-control" required>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="card-footer">
                      <button class="btn btn-sm btn-primary">Simpan Perubahan</button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header bg-orange">
                    <p class="text-white m-0">Rekening Perusahaan</p>
                  </div>
                  <form method="POST" action="{{route('profile.update-akun')}}">
                    @csrf
                  <div class="card-body">
                      @if ($errors->any())
                      <div class="pt-4 pb-2">
                          @foreach ($errors->all() as $error)
                            <p class="text-center small text-red">{{ $error }}</p>
                          @endforeach
                        </div>
                      @endif
                      <div class="form-group">
                        <label for="">Nama bank:</label>
                        <input type="text" placeholder="Nama Bank" name="rekening_nama" value="{{$data->rekening_nama}}" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="">No Rekening:</label>
                        <input type="text" placeholder="Nomer Rekening" name="rekening_nomer" value="{{$data->rekening_nomer}}" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="">Atas Nama:</label>
                        <input type="text" placeholder="Atas Nama" name="rekening_an" value="{{$data->rekening_an}}" class="form-control" required>
                      </div>
                    </div>
                  <div class="card-footer">
                    <button class="btn btn-sm bg-orange">
                      <p class="text-white m-0">Simpan Perubahan</p>
                    </button>
                  </div>
                  </form>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card">
                  <div class="card-header bg-green">
                    <p class="text-white m-0">Logo Perusahaan</p>
                  </div>
                  <form method="POST" action="{{route('profile.update-foto')}}" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    @if ($errors->any())
                      <div class="pt-4 pb-2">
                          @foreach ($errors->all() as $error)
                            <p class="text-center small text-red">{{ $error }}</p>
                          @endforeach
                        </div>
                      @endif
                      <div class="form-group text-center">
                        @if ($data->logo == null)
                            <img src="{{asset('assets/dist/img/avatar.jpg')}}" class="img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{url('storage/konfig/' . $data->logo)}}" class="img-fluid img-circle elevation-2" alt="User Image">
                        @endif
                      </div>
                      <div class="form-group">
                        <input type="file" name="logo" required>
                      </div>
                    </div>
                  <div class="card-footer">
                    <button class="btn btn-sm bg-green">
                      <p class="text-white m-0">Update Logo</p>
                    </button>
                  </div>
                  </form>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header bg-green">
                    <p class="text-white m-0">Member Card</p>
                  </div>
                  <form method="POST" action="{{route('profile.update-foto')}}" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    @if ($errors->any())
                      <div class="pt-4 pb-2">
                          @foreach ($errors->all() as $error)
                            <p class="text-center small text-red">{{ $error }}</p>
                          @endforeach
                        </div>
                      @endif
                      <div class="form-group text-center">
                        @if ($data->member_card == null)
                            <img src="{{asset('assets/dist/img/avatar.jpg')}}" class="img-circle" alt="User Image">
                        @else
                            <img src="{{url('storage/konfig/' . $data->member_card)}}" class="img-fluid" alt="User Image">
                        @endif
                      </div>
                      <div class="form-group">
                        <input type="file" name="member_card" required>
                      </div>
                    </div>
                  <div class="card-footer">
                    <button class="btn btn-sm bg-green">
                      <p class="text-white m-0">Update Member Card</p>
                    </button>
                  </div>
                  </form>
                </div>
              </div>
              <div class="col-md-5">
                <div class="card">
                  <div class="card-header bg-green">
                    <p class="text-white m-0">Logo Nota</p>
                  </div>
                  <form method="POST" action="{{route('profile.update-foto')}}" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    @if ($errors->any())
                      <div class="pt-4 pb-2">
                          @foreach ($errors->all() as $error)
                            <p class="text-center small text-red">{{ $error }}</p>
                          @endforeach
                        </div>
                      @endif
                      <div class="form-group text-center">
                        @if ($data->logo_nota == null)
                            <img src="{{asset('assets/dist/img/avatar.jpg')}}" class="img-circle" alt="User Image">
                        @else
                            <img  src="{{url('storage/konfig/' . $data->logo_nota)}}" class="img-fluid" alt="User Image">
                        @endif
                      </div>
                      <div class="form-group">
                        <input type="file" name="logo_nota" required>
                      </div>
                    </div>
                  <div class="card-footer">
                    <button class="btn btn-sm bg-green">
                      <p class="text-white m-0">Update Logo Nota</p>
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