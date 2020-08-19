@extends('master.main')

@section('title', 'Halaman Tambah Data')

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Tambah Data Penjualan</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/sales" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tgl">Tanggal</label>
                                    <input type="date" class="form-control @error('tgl') is-invalid @enderror" name="tgl" id="tgl" value="{{ old('tgl') }}">
                                    @error('tgl')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pelanggan_kode">Kode Pelanggan</label>
                                    <select class="form-control  @error('pelanggan_kode') is-invalid @enderror " id="pelanggan_kode" name="pelanggan_kode">
                                        @foreach ($customers as $customer)
                                        <option value="{{ $customer->kode }}" {{ old('pelanggan_kode') == $customer->kode ? 'selected' : '' }} >
                                            {{ $customer->kode }} --- {{ $customer->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('pelanggan_kode')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="barang_kode">Kode Barang</label>
                                    <select class="form-control @error('barang_kode') is-invalid @enderror" id="barang_kode" name="barang_kode">
                                        @foreach ($stocks as $stock)
                                        <option value="{{ $stock->kode }}" >
                                            {{ $stock->kode }} --- {{ $stock->namaBarang }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('barang_kode')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jml">Jumlah</label>
                                    <input type="number" class="form-control @error('jml') is-invalid @enderror" name="jml" id="jml" placeholder="Masukkan Jumlah Barang" value="{{ old('jml') }}">
                                    @error('jml')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="potongan">Potongan</label>
                                    <input type="number" class="form-control @error('potongan') is-invalid @enderror" name="potongan" id="potongan" placeholder="Masukkan potongan harga" value="{{ old('potongan') }}">
                                    @error('potongan')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="ket">Keterangan</label>
                                    <textarea class="form-control @error('ket') is-invalid @enderror" rows="4" name="ket" id="ket" placeholder="Masukan keterangan">{{ old('ket') }}</textarea>
                                    @error('ket')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end">               
                                    <button type="submit" class="btn btn-primary">Tambah Data Penjualan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
