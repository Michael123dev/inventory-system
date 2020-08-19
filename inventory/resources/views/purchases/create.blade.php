@extends('master.main')

@section('title', 'Halaman Tambah Data')

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Tambah Data Pembelian</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/purchases" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="tgl">Tanggal</label>
                                    <input type="date" class="form-control @error('tgl') is-invalid @enderror" name="tgl" id="tgl" value="{{ old('tgl') }}" required>
                                    @error('tgl')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pemasok_kode">Kode Pemasok</label>
                                    <select class="form-control  @error('pemasok_kode') is-invalid @enderror" id="pemasok_kode" name="pemasok_kode">
                                        @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->kode }}" {{ old('pemasok_kode') == $supplier->kode ? 'selected' : '' }}>
                                            {{ $supplier->kode }} --- {{ $supplier->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('pemasok_kode')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="barang_kode">Kode Barang</label>
                                    <select class="form-control  @error('barang_kode') is-invalid @enderror" id="barang_kode" name="barang_kode">
                                        @foreach ($stocks as $stock)
                                        <option value="{{ $stock->kode }}" {{ old('barang_kode') == $stock->kode ? 'selected' : '' }}>
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
                                    <button type="submit" class="btn btn-primary">Tambah Data Pembelian</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
