@extends('master.main')

@section('title', 'Halaman Tambah Data')

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Tambah Data User</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/users" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Masukkan Username " value="{{ old('username') }}">
                                    @error('username')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Masukkan Nama Lengkap User" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Masukkan Email User" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="role">Jabatan</label>
                                    <input type="text" class="form-control @error('role') is-invalid @enderror" name="role" id="role" placeholder="Masukkan Jabatan User" value="{{ old('role') }}">
                                    @error('role')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="d-flex justify-content-end">               
                                    <button type="submit" class="btn btn-primary">Tambah Data User</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
