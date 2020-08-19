@extends('master.main')

@section('title', 'Halaman Stok Barang')

@section('search')
<form class="navbar-form navbar-left" action="/searchstocks" method="get">
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
                            <h3 class="panel-title">Data Stok Barang</h3>
                            <div class="right">
                                <a href="/stocks/create" class="btn btn-primary">Tambah Barang</a>
                            </div>
                        </div>
                        <div class="panel-body">
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stocks as $stock)
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
                                        <td>
                                            <a href="/stocks/{{ $stock->id }}/edit" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <form action="/stocks/{{$stock->id}}" method="post" style="display:inline-block">  
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