<?php

namespace App\Http\Controllers;

use App\Customer;

use App\Supplier;

use App\Stock;

use App\Sale;

use App\Purchase;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $page = 'home';
        $customers = Customer::all();
        $suppliers = Supplier::all();
        $stocks = Stock::all();
        $sales = Sale::all();
        $purchases = Purchase::all();
        $lessStock = Stock::where('jumlah', '<=', 10)->get();
        return view('home', compact('page', 'customers', 'suppliers', 'stocks', 'sales', 'purchases', 'lessStock'));

    }

}
