<?php

namespace App\Http\Controllers;

use App\Http\Requests\KeranjangRequest;
use App\Http\Requests\PenjualanItemAddRequest;
use App\Http\Requests\PenjualanRequest;
use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\PenjualanItem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now()->toDateString();
        $invoice = Carbon::now()->format('ymdhs');
        $barang = Barang::with(['kategori', 'satuan', 'harga'])->paginate('10');
        $penjualan = Penjualan::with(['items', 'pelanggan'])->where('status', 'belum')->latest()->paginate(5);        
        $penjualanCount = Penjualan::with('items')->where('status', 'belum')->count();

        return view('dashboard.halaman.penjualan.index', compact(['currentDate', 'invoice', 'barang', 'penjualan', 'penjualanCount']));
    }

    public function edit(string $id)
    {
        // $currentDate = Carbon::now()->toDateString();
        // $invoice = Carbon::now()->format('ymdhs');
        $barang = Barang::with(['kategori', 'satuan', 'harga'])->paginate('10');
        // $penjualan = Penjualan::with(['items', 'pelanggan'])->where('status', 'belum')->latest()->paginate(5);        
        // $penjualanCount = Penjualan::with('items')->where('status', 'belum')->count();
        $penjualan = Penjualan::with(['items', 'pelanggan'])->where('id', $id)
        ->first();  //where pelanggan with relation barang
        $keranjang = DB::table('penjualan_items as k')
        ->join('barangs as b', 'b.id', '=', 'k.id_barang')
        ->select('k.id as keranjang_id', 'k.*', 'b.*', 'b.id as barang_id')
        ->where('k.id_penjualan', '=', $penjualan->id)
        ->get();

        // $penjualanIT = PenjualanItem::where('id_penjualan', $penjualan->id)->get();        

        // return response()->json($penjualan);

        return view('dashboard.halaman.penjualan.edit', compact(['barang', 'penjualan', 'keranjang']));
    }

    public function tambahItemAntrian(PenjualanItemAddRequest $request)
    {
        $data = $request->validated();

        if ($data['jenis'] == 1) {
            $data['total'] =  ($data['harga'] - 0) * $data['kuantitas'];

            PenjualanItem::create([
                'id_penjualan' => $data['id_penjualan'],
                'id_barang' => $data['id_barang'],
                'harga' => $data['harga'],
                'ukuran' => 'Pcs/Unit',
                'diskon' => 0,
                'kuantitas' => $data['kuantitas'],
                'total' => $data['total'],
            ]);
        } else {
            $data['total'] = (($data['ukuran_p'] * $data['ukuran_l']) * (($data['harga'] - 0) / (100 * 100))) * $data['kuantitas'];
            PenjualanItem::create([
                'id_penjualan' => $data['id_penjualan'],
                'id_barang' => $data['id_barang'],
                'ukuran_p' => $data['ukuran_p'],
                'ukuran_l' => $data['ukuran_l'],
                'harga' => $data['harga'],
                'diskon' => 0,
                'kuantitas' => $data['kuantitas'],
                'total' => $data['total'],
            ]);
        }

        $keranjang = DB::table('penjualan_items as k')
        ->join('barangs as b', 'b.id', '=', 'k.id_barang')
        ->select('k.id as keranjang_id', 'k.*', 'b.*', 'b.id as barang_id')
        ->where('k.id_penjualan', '=', $data['id_penjualan'])
        ->get();
        $bayar = Penjualan::where('id', $data['id_penjualan'])->first(); 

        $totalK = $keranjang->sum('total');
        $bayar->update([
            'sub_total' => $totalK,
            'grand_total' => $totalK,
        ]);
        $total = $totalK;
        $sisa = (int) $totalK - (int) $bayar->bayar;

        return response()->json(['data' => $keranjang, 'sub_total' => $total, 'sisa' => $sisa, 'msg' => 'success'], 200);
    }

    public function hapusItemAntrian(Request $request)
    {
        $id = $request->id;
        $idPenjualan = $request->id_penjualan;

        PenjualanItem::findorfail($id)->delete();

        $keranjang = DB::table('penjualan_items as k')
        ->join('barangs as b', 'b.id', '=', 'k.id_barang')
        ->select('k.id as keranjang_id', 'k.*', 'b.*', 'b.id as barang_id')
        ->where('k.id_penjualan', '=', $idPenjualan)
        ->get();

        $total = $keranjang->sum('total');
        $bayar = Penjualan::where('id', $idPenjualan)->first();
        $bayar->update([
            'sub_total' => $total,
            'grand_total' => $total,
        ]); 
        $sisa = (int) $total - (int) $bayar->bayar;

        return response()->json(['data' => $keranjang, 'sub_total' => $total, 'sisa' => $sisa, 'msg' => 'success'], 200);
    }

    public function cariPelanggan(Request $request)
    {
        if ($request->has('q')) {
            $keyword = $request->q;
            $data = Pelanggan::where('nama', 'LIKE', '%' . $keyword . '%')->get();
            return response()->json($data);
        }
    }
    public function listBarang(Request $request)
    {
        $id = $request->id_pelanggan;
        $pelanggan = Pelanggan::where('id', $id)->first();
        $barang = Barang::with(['kategori', 'satuan', 'harga'])->paginate('10');
        return response()->json([
            'pelanggan' => $pelanggan,
            'barang' => $barang,
            'msg' => 'success'
        ], 200);
    }
    public function cariBarang(Request $request)
    {
        $keyword = $request->input('param');
        $id = $request->id_pelanggan;
        $pelanggan = Pelanggan::where('id', $id)->first();
        $barang = Barang::where('nama', 'LIKE', "%$keyword%")->with(['kategori', 'satuan', 'harga'])->paginate(10);
        return response()->json([
            'pelanggan' => $pelanggan,
            'barang' => $barang,
            'msg' => 'success'
        ], 200);
    }

    public function checkKeranjang(Request $request)
    {
        $id = $request->id_pelanggan;

        $keranjang = DB::table('keranjangs as k')
        ->join('barangs as b', 'b.id', '=', 'k.id_barang')
        ->select('k.id as keranjang_id', 'k.*', 'b.*', 'b.id as barang_id')
        ->where('k.id_pelanggan', '=', $id)
        ->get();

        $total = $keranjang->sum('total');

        return response()->json(['data' => $keranjang, 'sub_total' => $total, 'msg' => 'success'], 200);
    }

    public function tambahKeranjang(KeranjangRequest $request)
    {
        $data = $request->validated();

        if ($data['jenis'] == 1) {
            $data['total'] =  ($data['harga'] - 0) * $data['kuantitas'];

            Keranjang::create([
                'id_pelanggan' => $data['id_pelanggan'],
                'id_barang' => $data['id_barang'],
                'harga' => $data['harga'],
                'ukuran' => 'Pcs/Unit',
                'kuantitas' => $data['kuantitas'],
                'total' => $data['total'],
            ]);
        } else {
            $data['total'] = (($data['ukuran_p'] * $data['ukuran_l']) * (($data['harga'] - 0) / (100 * 100))) * $data['kuantitas'];
            Keranjang::create([
                'id_pelanggan' => $data['id_pelanggan'],
                'id_barang' => $data['id_barang'],
                'ukuran_p' => $data['ukuran_p'],
                'ukuran_l' => $data['ukuran_l'],
                'harga' => $data['harga'],
                'kuantitas' => $data['kuantitas'],
                'total' => $data['total'],
            ]);
        }

        $keranjang = DB::table('keranjangs as k')
        ->join('barangs as b', 'b.id', '=', 'k.id_barang')
        ->select('k.id as keranjang_id', 'k.*', 'b.*', 'b.id as barang_id')
        ->where('k.id_pelanggan', '=', $data['id_pelanggan'])
        ->get(); 

        $total = $keranjang->sum('total');

        return response()->json(['data' => $keranjang, 'sub_total' => $total, 'msg' => 'success'], 200);
    }

    public function hapusKeranjang(Request $request)
    {
        $id = $request->id;
        $idPelanggan = $request->id_pelanggan;

        Keranjang::findorfail($id)->delete();

        $keranjang = DB::table('keranjangs as k')
        ->join('barangs as b', 'b.id', '=', 'k.id_barang')
        ->select('k.id as keranjang_id', 'k.*', 'b.*', 'b.id as barang_id')
        ->where('k.id_pelanggan', '=', $idPelanggan)
        ->get();

        $total = $keranjang->sum('total');

        return response()->json(['data' => $keranjang, 'sub_total' => $total, 'msg' => 'success'], 200);
    }

    public function simpanKeranjang(PenjualanRequest $request)
    {
        $data = $request->validated();

        $idKasir = auth()->user()->id;

        if ($data['grand_total'] <= $data['bayar'] ) {
            $data['sisa'] = 0;
            $data['status_bayar'] = 'lunas';
        }else {
            $data['status_bayar'] = 'belum';
        }
        $penjualan = Penjualan::create([
            'no_nota' => 'BP' . $data['no_nota'],
            'id_pelanggan' => $data['id_pelanggan'],
            'id_kasir' => $idKasir,
            'tgl_penjualan' => $data['tgl_penjualan'],
            'sub_total' => $data['sub_total'],
            'diskon' => $data['diskon_sub'],
            'grand_total' => $data['grand_total'],
            'tgl_pengambilan' => $data['tgl_pengambilan'],
            'bayar' => $data['bayar'],
            'sisa' => $data['sisa'],
            'status_bayar' => $data['status_bayar'],
            'catatan' => $data['catatan'],
        ]);

        $keranjang = Keranjang::where('id_pelanggan', $data['id_pelanggan'])->get();
        if ($penjualan) {
    
            foreach ($keranjang as $item) {
                $formData = [];
                $barang = Barang::where('id', $item->id_barang)->first();
                $dt = [];
                if ($item->ukuran == null) {
                    $formData = [
                        'id_penjualan' => $penjualan->id,
                        'id_barang' => $item->id_barang,
                        'ukuran_p' => $item->ukuran_p,
                        'ukuran_l' => $item->ukuran_l,
                        'harga' => $item->harga,
                        'kuantitas' => $item->kuantitas,
                        'diskon' => $item->diskon,
                        'total' => $item->total,
                    ];

                    $dt = [
                        'stok_p' => $barang->stok_p - $item->ukuran_p,
                        'stok_l' => $barang->stok_l - $item->ukuran_l,
                    ];
                }else{
                    $formData = [
                        'id_penjualan' => $penjualan->id,
                        'id_barang' => $item->id_barang,
                        'ukuran' => $item->ukuran,
                        'harga' => $item->harga,
                        'kuantitas' => $item->kuantitas,
                        'diskon' => $item->diskon,
                        'total' => $item->total,
                    ];

                    $dt = [
                        'stok' => $barang->stok - $item->kuantitas,
                    ];
                }
                $barang->update($dt);
                PenjualanItem::create($formData);
                $item->delete();
            }
            Keranjang::truncate();
        }else{
            toastr()->error('Gagal');
            return redirect()->back()->withInput();
        }

        if ($data['metode'] == 'online') {
                
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            // SNAP
            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => $data['bayar'],
                )
            );
            
            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                $penjualan->update([
                    'snap_token' => $snapToken
                ]);
            } catch (\Exception $e) {
                // Log the error or handle it as needed
                error_log($e->getMessage());
                // You can also return an error response if needed
                return response()->json(['error' => 'Failed to get snap token. Please check your server key and environment settings.']);
            }
            return redirect()->route('penjualan.bayar', $penjualan->id);
        }else{
            toastr()->success('Berhasil');
            return redirect()->route('penjualan');
        }
    }

    public function penjualanBayar(string $id){
        $data = Penjualan::where('id', $id)->first();
        return view('dashboard.halaman.penjualan.bayar', compact(['data']));
    }
    public function penjualanSukses(string $id){
        $data = Penjualan::where('id', $id)->first();

        return view('dashboard.halaman.penjualan.bayar-sukses', compact(['data']));
    }

    public function bayarOnline(string $id, Request $request)
    {
        $metode = $request->metode;
        $bayar = $request->bayar;
        $penjualan = Penjualan::where('id', $id)->first();

        if ($metode == 'online') {
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;
    
            // SNAP
            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => $bayar,
                )
            );
            
            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                $penjualan->update([
                    'snap_token' => $snapToken,
                    'bayar' => $bayar,
                ]);
                if ($penjualan->grand_total <= ($bayar + $penjualan->bayar) ) {
                    $penjualan->update([
                        'sisa' => 0,
                    ]);
                }else {
                    $penjualan->update([
                        'status_bayar' => 'belum'
                    ]);
                }
            } catch (\Exception $e) {
                // Log the error or handle it as needed
                error_log($e->getMessage());
                // You can also return an error response if needed
                return response()->json(['error' => 'Failed to get snap token. Please check your server key and environment settings.']);
            }
            return redirect()->route('penjualan.bayar', $penjualan->id);
        }else{
            $dt = [
                'bayar' => $penjualan->grand_total,
                'sisa' => 0,
                'status_bayar' => 'lunas',
            ];
            $penjualan->update($dt);

            toastr()->success('Berhasil');
    
            return redirect()->route('penjualan');
        }

    }

    public function saveToLaporan(string $id){
        $penjualan = Penjualan::where('id', $id)->first();

        if ($penjualan) {
            $dt = [
                'bayar' => $penjualan->grand_total,
                'sisa' => 0,
                'status_bayar' => 'lunas',
                'status' => 'selesai',
            ];
            $penjualan->update($dt);
            
            toastr()->success('Berhasil');
    
            return redirect()->route('penjualan');
        }
    }
}
