@extends('master.main')

@section('title', 'Halaman Edit Data Pemasok')

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Ubah Data Pemasok</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/suppliers/{{ $supplier->id }}" method="post">
                                @method('patch')
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama Pemasok</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Masukkan Nama Pemasok" value="{{ $supplier->nama }}">
                                    @error('nama')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" placeholder="Masukkan Alamat Pemasok" value="{{ $supplier->alamat }}">
                                    @error('alamat')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="telp">Telepon</label>
                                    <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" id="telp" placeholder="Masukkan No Telepon Pemasok" value="{{ $supplier->telp }}">
                                    @error('telp')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Masukkan No Email Pemasok" value="{{ $supplier->email }}">
                                    @error('email')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kota">Kota</label>
                                    <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" id="kota" placeholder="Masukkan Kota" value="{{ $supplier->kota }}">
                                    @error('kota')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tgl_masuk">Tanggal Masuk</label>
                                    <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" id="tgl_masuk" value="{{ $supplier->tgl_masuk }}">
                                    @error('tgl_masuk')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end">               
                                    <button type="submit" class="btn btn-primary">Ubah Data</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
