@if (count($barang) >= 1)
    @foreach ($barang as $item)
    <tr>
        <td>{{$item->kode}}</td>
        <td>{{$item->nama}}</td>
        <td>{{$item->kategori->nama}}</td>
        <td>{{$item->satuan->nama}}</td>
        <td><button type="button" id="btnPilih" class="btn btn-sm btn-primary" data-id="{{$item->id}}" data-kode="{{$item->kode}}" data-nama="{{$item->nama}}" data-stok="{{$item->stok}}" data-kategori="{{$item->kategori->nama}}" data-satuan="{{$item->satuan->nama}}"><i class="fa fa-check"></i> Pilih</button></td>
    </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center">Belum ada data</td>
    </tr>
@endif