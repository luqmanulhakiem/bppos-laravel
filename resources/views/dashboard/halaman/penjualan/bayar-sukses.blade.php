@extends('dashboard.index')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bayar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Bayar</li>

            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="card text-center">
            <div class="card-body">
              <p>anda berhasil melakukan pembayaran sebesar {{$data->nominal}}</p>
              <button class="btn btn-primary" id="pay-button">Cetak Pembayaran</button>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
@endsection

@section('scripts-midtrans')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>
    <script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{$data->snap_token}}', {
        // Optional
        onSuccess: function(result){
            ///donasi-sukses/{id}
            window.location.href = "{{route('penjualan.sukses', ['id' => $data->id])}}"
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        }
        });
    };
    </script>
@endsection