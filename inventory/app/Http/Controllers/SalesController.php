<?php

namespace App\Http\Controllers;

use App\Sale;

use App\Stock;

use App\Customer;

use Illuminate\Http\Request;

use Haruncpi\LaravelIdGenerator\IdGenerator;

class SalesController extends Controller
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
        $page = 'sales';
        $search = $request->get('search');
        $sales = Sale::where('noNota', 'LIKE', '%' . $search . '%')->orWhere('pelanggan_kode', 'LIKE', '%' . $search . '%')->paginate(5);
        return view('sales.index', compact('sales', 'page'));
    }

    public function index()
    {   
        $page = 'sales';
        $sales = Sale::orderBy('id', 'DESC')->get();
        return view('sales.index', compact('sales', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'sales';
        $stocks = Stock::all();
        $customers = Customer::all();
        return view('sales.create', compact('page', 'stocks', 'customers'));
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
            'pelanggan_kode' => 'required',
            'barang_kode' => 'required',
            'jml' => 'required|numeric',
            'potongan' => 'required|numeric',
            'ket' => 'required',
        ]);

        $config=['table'=>'sales','length'=>7, 'field'=>'noNota' , 'prefix'=>'NJ-'];
        $noNota = IdGenerator::generate($config);

        Sale::create([
            'noNota' => $noNota,
            'tgl' => $request->tgl,
            'pelanggan_kode' => $request->pelanggan_kode,
            'barang_kode' => $request->barang_kode,
            'jml' => $request->jml,
            'potongan' => $request->potongan,
            'ket' => $request->ket,
        ]);
        

        //Trigger pengurangan stok
        $stocks = Stock::where('kode', $request->barang_kode)->get();
        $stockAwal = $stocks[0]->jumlah;
        
        Stock::where('kode', $request->barang_kode)
        ->update([
            'jumlah' => $stockAwal - $request->jml,
        ]);
        return redirect('/sales')->with('status', 'Data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {   
        $page = 'sales';
        $stocks = Stock::all();
        $customers = Customer::all();
        return view('sales.edit', compact('sale', 'page', 'stocks', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'tgl' => 'required|date',
            'pelanggan_kode' => 'required',
            'barang_kode' => 'required',
            'jml' => 'required|numeric',
            'potongan' => 'required|numeric',
            'ket' => 'required',
        ]);

        //Trigger pengurangan stok
        //Ambil stock awal data dari tabel stock
        $stocks = Stock::where('kode', $sale->barang_kode)->get();
        $stockAwal = $stocks[0]->jumlah;
        //Ambil jumlah barang yang dijual sebelum di edit (ambil data jumlah dari tabel sale ) 
        $sales = Sale::where('id', $sale->id)->get();
        $createRequest = $sales[0]->jml; 

        
        Sale::where('id', $sale->id)
        ->update([
            'tgl' => $request->tgl,
            'pelanggan_kode' => $request->pelanggan_kode,
            'barang_kode' => $request->barang_kode,
            'jml' => $request->jml,
            'potongan' => $request->potongan,
            'ket' => $request->ket,
        ]);


        Stock::where('kode', $sale->barang_kode)
        ->update([
            // jumlah akhir = stok awal + penjualan awal (untuk mengembalikan seperti semula) - request edit terbaru
            'jumlah' => ($stockAwal + $createRequest) - $request->jml,
        ]);


        return redirect('/sales')->with('update', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        
        $stocks = Stock::where('kode', $sale->barang_kode)->get();
        $stockAwal = $stocks[0]->jumlah;
        $sales = Sale::where('id', $sale->id)->get();
        $updateRequest = $sales[0]->jml; 

        Stock::where('kode', $sale->barang_kode)
        ->update([
            // jumlah akhir = stok awal + penjualan awal (untuk mengembalikan seperti semula) - request edit terbaru
            'jumlah' => $stockAwal + $updateRequest,
        ]);


        Sale::destroy($sale->id);
        return redirect('/sales')->with('delete', ' Data berhasil dihapus');
    }
}
