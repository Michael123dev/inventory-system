@extends('master.main')

@section('title', 'Halaman User')

@section('search')
<form class="navbar-form navbar-left" action="/searchusers" method="get">
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
                            <h3 class="panel-title">Data User</h3>
                            <div class="right">
                                <a href="/users/create" class="btn btn-primary">Tambah User</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Jabatan</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td><a href="/users/{{ $user->id }}">{{ $user->username }}</a></td>
                                        <td><a href="/users/{{ $user->id }}">{{ $user->name }}</a></td>
                                        <td><a href="/users/{{ $user->id }}">{{ $user->email }}</a></td>
                                        <td><a href="/users/{{ $user->id }}">{{ $user->role}}</a></td>
                                        <td><a href="/users/{{ $user->id }}">{{ $user->tgl_masuk }}</a></td>
                                        <td>
                                            <a href="/users/{{ $user->id }}/edit" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <form action="/users/{{$user->id}}" method="post" style="display:inline-block">  
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