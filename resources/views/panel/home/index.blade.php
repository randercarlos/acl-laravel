@extends('panel.template.panel')

@section('title-page')
    Home
@endsection


@section('breadcrumb')
    <li class="active">Home</li> 
@endsection 


@section('content')

        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-success"><i class="ion-social-usd"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter">{{ $totalPosts }}</span>
                        <span class="dashboard-text">Posts</span>
                    </div>
                </div>
            </div>
            
            
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-purple"><i class="ion-eye"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter">{{ $totalRoles }}</span>
                        <span class="dashboard-text">Papéis</span>
                    </div>
                </div>
            </div>
    
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-pink"><i class="ion-android-contacts"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter">{{ $totalUsers }}</span>
                        <span class="dashboard-text">Usuários</span>
                    </div>
                </div>
            </div>
            
            
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-info"><i class="ion-ios7-cart"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter">{{ $totalPermissions }}</span>
                        <span class="dashboard-text">Permissões</span>
                    </div>
                </div>
            </div>
            
        </div> 


@endsection