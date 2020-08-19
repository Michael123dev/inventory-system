<?php

namespace App\Http\Controllers;

use App\Purchase;

use App\Stock;

use App\Supplier;

use Illuminate\Http\Request;

use Haruncpi\LaravelIdGenerator\IdGenerator;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {   
        $page = 'purchases';
        $search = $request->get('search');
        $purchases = Purchase::where('noNota', 'LIKE', '%' . $search . '%')->orWhere('barang_kode', 'LIKE', '%' . $search . '%')->paginate(5);
        return view('purchases.index', compact('purchases', 'page'));
    }

    public function index()
    {
        $page = 'purchases';
        $purchases = Purchase::orderBy('id', 'DESC')->get();
        return view('purchases.index', compact('purchases', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'purchases';
        $stocks = Stock::all();
        $suppliers = Supplier::all();
        return view('purchases.create', compact('page', 'stocks', 'suppliers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'tgl' => 'required|date',
            'pemasok_kode' => 'required',
            'barang_kode' => 'required',
            'jml' => 'required|numeric',
            'potongan' => 'required|numeric',
            'ket' => 'required|string',
        ]);

        $config=['table'=>'purchases','length'=>7, 'field'=>'noNota' , 'prefix'=>'NB-'];
        $noNota = IdGenerator::generate($config);

        Purchase::create([
            'noNota' => $noNota,
            'tgl' => $request->tgl,
            'pemasok_kode' => $request->pemasok_kode,
            'barang_kode' => $request->barang_kode,
            'jml' => $request->jml,
            'potongan' => $request->potongan,
            'ket' => $request->ket,
        ]);

        //Trigger penambahan stok
        $stocks = Stock::where('kode', $request->barang_kode)->get();
        $stockAwal = $stocks[0]->jumlah;
        
        Stock::where('kode', $request->barang_kode)
        ->update([
            'jumlah' => $stockAwal + $request->jml,
        ]);

        return redirect('/purchases')->with('status', 'Data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $page = 'purchases';
        $stocks = Stock::all();
        $suppliers = Supplier::all();
        return view('purchases.edit', compact('purchase', 'page', 'stocks', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'tgl' => 'required|date',
            'pemasok_kode' => 'required',
            'barang_kode' => 'required',
            'jml' => 'required|numeric',
            'potongan' => 'required|numeric',
            'ket' => 'required|string',
        ]);
        
        //Trigger penambahan stok
        //Ambil stock awal data dari tabel stock
        $stocks = Stock::where('kode', $purchase->barang_kode)->get();
        $stockAwal = $stocks[0]->jumlah;
        //Ambil jumlah barang yang dibeli sebelum di edit (ambil data jumlah dari tabel purchase ) 
        $purchases = Purchase::where('id', $purchase->id)->get();
        $createRequest = $purchases[0]->jml; 

        Purchase::where('id', $purchase->id)
        ->update([
            'tgl' => $request->tgl,
            'pemasok_kode' => $request->pemasok_kode,
            'barang_kode' => $request->barang_kode,
            'jml' => $request->jml,
            'potongan' => $request->potongan,
            'ket' => $request->ket,
        ]);

        Stock::where('kode', $purchase->barang_kode)
        ->update([
            // jumlah akhir = stok awal - pembelian awal (untuk mengembalikan seperti semula) + request edit terbaru
            'jumlah' => ($stockAwal - $createRequest) + $request->jml,
        ]);

        return redirect('/purchases')->with('update', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $stocks = Stock::where('kode', $purchase->barang_kode)->get();
        $stockAwal = $stocks[0]->jumlah;
        $purchases = Purchase::where('id', $purchase->id)->get();
        $updateRequest = $purchases[0]->jml; 

        Stock::where('kode', $purchase->barang_kode)
        ->update([
            // jumlah akhir = stok awal + penjualan awal (untuk mengembalikan seperti semula) - request edit terbaru
            'jumlah' => $stockAwal - $updateRequest,
        ]);


        Purchase::destroy($purchase->id);
        return redirect ('/purchases')->with('delete', 'Data berhasil dihapus');
    }
}
