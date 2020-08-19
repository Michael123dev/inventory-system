@extends('master.main')

@section('title', 'Halaman Penjualan')

@section('search')
<form class="navbar-form navbar-left" action="/searchsales" method="get">
    <div class="input-group">
        <input type="text" value="" name="search" class="form-control" placeholder="Search dashboard...">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Go</button>
        </span>
    </div>
</form>
@endsection

@section('content')

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-check-circle"></i> {{ session('status') }}
                    </div>
                    @endif 

                    @if (session('update'))
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-check-circle"></i> {{ session('update') }}
                    </div>
                    @endif 

                    @if (session('delete'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <i class="fa fa-check-circle"></i> {{ session('delete') }}
                    </div>
                    @endif 

                    <!-- DATA TABLE -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Penjualan</h3>
                            <div class="right">
                                <a href="/sales/create" class="btn btn-primary">Tambah Data Penjualan</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No. Nota</th>
                                        <th>Tanggal</th>
                                        <th>Kode Pelanggan</th>
                                        <th>Kode Barang</th>
                                        <th>Jumlah</th>
                                        <th>Potongan</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $sale) 
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $sale->noNota }}</td>
                                        <td>{{ $sale->tgl }}</td>
                                        <td>{{ $sale->pelanggan_kode }}</td>
                                        <td>{{ $sale->barang_kode }}</td>
                                        <td>{{ $sale->jml }}</td>
                                        <td>{{ $sale->potongan }}</td>
                                        <td>{{ $sale->ket }}</td>
                                        <td>
                                            <a href="sales/{{ $sale->id }}/edit" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <form action="/sales/{{ $sale->id }}" method="post" style="display:inline-block">  
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger d-inline " onclick="return confirm('Yakin ingin dihapus?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>

        </div>
    </div>
    <!-- END MAIN CONTENT -->
@endsection