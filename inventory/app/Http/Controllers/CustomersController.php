<?php

namespace App\Http\Controllers;

use App\Customer;

use Illuminate\Http\Request;

use Haruncpi\LaravelIdGenerator\IdGenerator;

class CustomersController extends Controller
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
        $page = 'customers';
        $search = $request->get('search');
        $customers = Customer::where('nama', 'LIKE', '%' . $search . '%')->orWhere('kota', 'LIKE', '%' . $search . '%')->paginate(5);
        return view('customers.index', compact('customers', 'page'));
    }

    public function index()
    {   $page = 'customers';
        $customers = Customer :: orderBy('created_at', 'desc')->get();
        return view('customers.index', compact('customers', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $page = 'customers';
        return view('customers.create', compact('page'));
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
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:13',
            'email' => 'required|email:rfc,dns',
            'kota' => 'required|string|max:20',
            'tgl_masuk' => 'required|date'
            ]);

            $config=['table'=>'customers','length'=>7, 'field'=>'kode' , 'prefix'=>'CU-'];
            $kode = IdGenerator::generate($config);

            Customer::create([
                'kode' => $kode,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'email' => $request->email,
                'kota' => $request->kota,
                'tgl_masuk' => $request->tgl_masuk,

            ]);

            // $customer = new Customer;
            // $customer->kode = $kode;
            // $customer->nama = $request->nama;
            // $customer->alamat = $request->alamat;
            // $customer->telp = $request->telp;
            // $customer->email = $request->email;
            // $customer->kota = $request->kota;
            // $customer->tgl_masuk = $request->tgl_masuk;
            // $customer->save();

            return redirect('/customers')->with('status', 'Data Berhasil Ditambahkan');
        }
        
    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {   
        $page = 'customers';
        return view('customers.show', compact('customer', 'page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {   
        $page = 'customers';
        return view('customers.edit', compact('customer', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required',
            'telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:13',
            'email' => 'required|email:rfc,dns',
            'kota' => 'required|string|max:20',
            'tgl_masuk' => 'required|date'
        ]);

        Customer::where('id', $customer->id)
        ->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'email' => $request->email,
            'kota' => $request->kota,
            'tgl_masuk' => $request->tgl_masuk,
        ]);

        return redirect('/customers')->with('update', ' Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        Customer::destroy($customer->id);
        return redirect('/customers')->with('delete', ' Data berhasil dihapus');
    }
}
