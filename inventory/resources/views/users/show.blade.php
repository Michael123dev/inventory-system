@extends('master.main')

@section('title', 'Halaman Profile User')

@section('header')
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endsection

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="panel panel-profile">
            <div class="clearfix">
                <!-- LEFT COLUMN -->
                <div class="profile-left">
                    <!-- PROFILE HEADER -->
                    <div class="profile-header">
                        <div class="overlay"></div>
                        <div class="profile-main">
                            <img src="{{ asset('admin/assets/img/nopic.jpg')}}" class="img-circle" alt="Avatar" width="120px">
                            <h3 class="name">{{ $user->name }}</h3>
                            <span class="online-status status-available">Available</span>
                        </div>
                        <div class="profile-stat">
                            
                        </div>
                    </div>
                    <!-- END PROFILE HEADER -->
                    <!-- PROFILE DETAIL -->
                    <div class="profile-detail">
                        <div class="profile-info">
                            <h4 class="heading">Detail Info</h4>
                            <ul class="list-unstyled list-justify">
                                <li>Username <span>{{ $user->username }}</span></li>
                                <li>Nama <span>{{ $user->name }}</span></li>
                                <li>Email <span>{{ $user->email }}</span></li>
                                <li>Jabatan <span>{{ $user->role }}</span></li>
                                <li>Tanggal Masuk <span>{{ $user->tgl_masuk }}</span></li>
                            </ul>
                        </div>
                        
                    </div>
                    <!-- END PROFILE DETAIL -->
                </div>
                <!-- END LEFT COLUMN -->
                
            </div>
        </div>
    </div>
</div>
@endsection