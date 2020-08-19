<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StocksController extends Controller
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
        $page = 'stocks';
        $search = $request->get('search');
        $stocks = Stock::where('namaBarang', 'LIKE', '%' . $search . '%')->orWhere('login', 'LIKE', '%' . $search . '%')->paginate(5);
        return view('stocks.index', compact('stocks', 'page'));
    }
    
    public function index()
    {   
        $page = 'stocks';
        $stocks = Stock::orderBy('id', 'DESC')->get();
        return view('stocks.index', compact('stocks', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $page = 'stocks';
        return view('stocks.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'namaBarang' => 'required|string',
            'satuan' => 'required|string',
            'hargaBeli' => 'required|numeric',
            'hargaJual' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'tgl_masuk' => 'required|date',
        ]);

        $config=['table'=>'stocks','length'=>7, 'field'=>'kode' , 'prefix'=>'ST-'];
        $kode = IdGenerator::generate($config);

        Stock::create([
            'kode' => $kode,
            'namaBarang' => $request->namaBarang,
            'satuan' => $request->satuan,
            'hargaBeli' => $request->hargaBeli,
            'hargaJual' => $request->hargaJual,
            'jumlah' => $request->jumlah,
            'tgl_masuk' => $request->tgl_masuk,
            'login' => auth()->user()->username,
        ]);

        // $stock = new Stock;
        // $stock->kode = $kode;
        // $stock->namaBarang = $request->namaBarang;
        // $stock->satuan = $request->satuan;
        // $stock->hargaBeli = $request->hargaBeli;
        // $stock->hargaJual = $request->hargaJual;
        // $stock->jumlah = $request->jumlah;
        // $stock->tgl_masuk = $request->tgl_masuk;
        // $stock->login = $request->login;
        // $stock->save();

        return redirect('/stocks')->with('status', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {   
        $page = 'stocks';
        return view('stocks.edit', compact('stock', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        // dd(auth()->user()->role);
        $request->validate([
            'namaBarang' => 'required|string',
            'satuan' => 'required|string',
            'hargaBeli' => 'required|numeric',
            'hargaJual' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'tgl_masuk' => 'required|date',
            
        ]);

        Stock::where('id', $stock->id)
            ->update([
                'namaBarang' => $request->namaBarang,
                'satuan' => $request->satuan,
                'hargaBeli' => $request->hargaBeli,
                'hargaJual' => $request->hargaJual,
                'jumlah' => $request->jumlah,
                'tgl_masuk' => $request->tgl_masuk,
                'login' => auth()->user()->username,
            ]);

        return redirect('/stocks')->with('update', 'Data berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        Stock::destroy($stock->id);
        return redirect('/stocks')->with('delete', 'Data berhasil dihapus');
    }
}
