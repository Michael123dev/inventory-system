@extends('master.main')

@section('title', 'Halaman Tambah Data')

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Tambah Data Stok Barang</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/stocks" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="namaBarang">Nama Barang</label>
                                    <input type="text" class="form-control @error('namaBarang') is-invalid @enderror" name="namaBarang" id="namaBarang" placeholder="Masukkan Nama Barang" value="{{ old('namaBarang') }}">
                                    @error('namaBarang')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" class="form-control @error('satuan') is-invalid @enderror" name="satuan" id="satuan" placeholder="Masukkan Satuan Barang" value="{{ old('satuan') }}">
                                    @error('satuan')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="hargaBeli">Harga Beli</label>
                                    <input type="number" class="form-control @error('hargaBeli') is-invalid @enderror" name="hargaBeli" id="hargaBeli" placeholder="Masukkan Harga Beli" value="{{ old('hargaBeli') }}">
                                    @error('hargaBeli')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="hargaJual">Harga Jual</label>
                                    <input type="number" class="form-control @error('hargaJual') is-invalid @enderror" name="hargaJual" id="hargaJual" placeholder="Masukkan Harga Jual" value="{{ old('hargaJual') }}">
                                    @error('hargaJual')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah" placeholder="Masukkan Jumlah Barang" value="{{ old('jumlah') }}">
                                    @error('jumlah')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_masuk">Tanggal Masuk</label>
                                    <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" id="tgl_masuk" value="{{ old('tgl_masuk') }}">
                                    @error('tgl_masuk')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end">               
                                    <button type="submit" class="btn btn-primary">Tambah Data Barang</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
