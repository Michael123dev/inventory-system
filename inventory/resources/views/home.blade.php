@extends('master.main')

@section('title', 'Halaman Dashoard')

@section('content')
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <!-- OVERVIEW -->
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Daily Overview</h3>
                    <p class="panel-subtitle"></p>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-users"></i></span>
                                <p>
                                    <span class="number">{{ $customers->count() }}</span>
                                    <span class="title">Pelanggan</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-archive"></i></span>
                                <p>
                                    <span class="number">{{ $stocks->count() }}</span>
                                    <span class="title">Jenis Barang</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                                <p>
                                    <span class="number">{{ $purchases->count() }}</span>
                                    <span class="title">Pembelian</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-sign-out"></i></span>
                                <p>
                                    <span class="number">{{ $sales->count() }}</span>
                                    <span class="title">Penjualan</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <h3 style="margin-bottom: 30px;">Barang yang Membutuhkan Tambahan Stock</h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Satuan</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Jumlah</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Ubah</th>
                                <th>Login</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lessStock as $stock)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $stock->kode }}</td>
                                <td>{{ $stock->namaBarang }}</td>
                                <td>{{ $stock->satuan }}</td>
                                <td>{{ $stock->hargaBeli }}</td>
                                <td>{{ $stock->hargaJual }}</td>
                                <td>{{ $stock->jumlah }}</td>
                                <td>{{ $stock->tgl_masuk }}</td>
                                <td>{{ $stock->tgl_ubah }}</td>
                                <td>{{ $stock->login }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
@endsection