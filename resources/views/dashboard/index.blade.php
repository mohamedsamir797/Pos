@extends('layouts.dashboard.app')

@section('head')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">@if(app()->getLocale() == 'ar') @lang('site.dashboard') @else Home @endif </a></li>
        </ol>
    </div>
@endsection

@section('title')
    <h1 class="display-4">@if(app()->getLocale() == 'ar') @lang('site.dashboard') @else Dashboard @endif</h1>

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $products->count()  }}</h3>

                    <p>@if(app()->getLocale() == 'ar') @lang('site.products') @else products @endif</p>

                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('dashboard.products.index') }}" class="small-box-footer">@if(app()->getLocale() == 'ar') @lang('site.show') @else show @endif<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $orders->count() }}<sup style="font-size: 20px"></sup></h3>

                    <p>@if(app()->getLocale() == 'ar') @lang('site.orders') @else Order @endif</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('dashboard.orders.index') }}" class="small-box-footer">@if(app()->getLocale() == 'ar') @lang('site.show') @else show @endif <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $clients->count() }}</h3>

                    <p>@if(app()->getLocale() == 'ar') @lang('site.clients') @else clients @endif</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('dashboard.clients.index') }}" class="small-box-footer">@if(app()->getLocale() == 'ar') @lang('site.show') @else show @endif <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $categories->count() }}</h3>

                    <p>@if(app()->getLocale() == 'ar') @lang('site.categories') @else categories @endif</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('dashboard.categories.index') }}" class="small-box-footer">@if(app()->getLocale() == 'ar') @lang('site.show') @else show @endif<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    @endsection
