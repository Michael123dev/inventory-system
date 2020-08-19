<?php

namespace App\Http\Controllers;

use App\Supplier;

use Illuminate\Http\Request;

use Haruncpi\LaravelIdGenerator\IdGenerator;

class SuppliersController extends Controller
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
        $page = 'suppliers';
        $search = $request->get('search');
        $suppliers = Supplier::where('nama', 'LIKE', '%' . $search . '%')->orWhere('kota', 'LIKE', '%' . $search . '%')->paginate(5);
        return view('suppliers.index', compact('suppliers', 'page'));
    }
    
    public function index()
    {   
        $page = 'suppliers';
        $suppliers = Supplier :: orderBy('created_at', 'DESC')->get();
        return view('suppliers.index', compact('suppliers', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $page = 'suppliers';
        return view('suppliers.create', compact('page'));
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
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:13',
            'email' => 'required|email:rfc,dns',
            'kota' => 'required|string|max:20',
            'tgl_masuk' => 'required|date'
            ]);

            $config=['table'=>'suppliers','length'=>7, 'field'=>'kode' , 'prefix'=>'SU-'];
            $kode = IdGenerator::generate($config);

            Supplier::create([
                'kode' => $kode,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'email' => $request->email,
                'kota' => $request->kota,
                'tgl_masuk' => $request->tgl_masuk,
            ]);

            return redirect('/suppliers')->with('status', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        $page = 'suppliers';
        return view('suppliers.show', compact('supplier', 'page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $page = 'suppliers';
        return view('suppliers.edit', compact('supplier', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:13',
            'email' => 'required|email:rfc,dns',
            'kota' => 'required|string|max:20',
            'tgl_masuk' => 'required|date'
        ]);

        Supplier::where('id', $supplier->id)
            ->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'email' => $request->email,
                'kota' => $request->kota,
                'tgl_masuk' => $request->tgl_masuk,
            ]);
        
        return redirect('/suppliers')->with('update', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        Supplier::destroy($supplier->id);
        return redirect('/suppliers')->with('delete', ' Data berhasil dihapus');
    }
}
