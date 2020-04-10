@extends('layouts.dashboard.app')

@section('title')
    <h1 class="display-4">@if(app()->getLocale() == 'ar') @lang('site.orders') @else orders @endif</h1>
@endsection

@section('head')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a
                        href="{{ route('dashboard.index') }}">@if(app()->getLocale() == 'ar') @lang('site.dashboard') @else
                        Home @endif </a></li>
            <li class="breadcrumb-item active"><a
                        href="{{ route('dashboard.orders.index') }}"> @if(app()->getLocale() == 'ar') @lang('site.orders') @else
                        orders @endif </a></li>
            <li class="breadcrumb-item active"><a
                        href="{{ route('dashboard.orders.create') }}"> @if(app()->getLocale() == 'ar') @lang('site.add') @else
                        Add @endif </a></li>

        </ol>
    </div>
@endsection

@section('content')
    <div class="col col-11 card card-info">
        <div class="card-header">
            <h3 class="card-title">@if(app()->getLocale() == 'ar') @lang('site.add') @else Add @endif</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @include('dashboard.allErorrs')
        <form action="{{ route('dashboard.orders.store') }}" method="post">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">@if(app()->getLocale() == 'ar') @lang('site.name') @else
                            name @endif </label>
                    <input type="text" class="form-control" name="name" >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">@if(app()->getLocale() == 'ar') @lang('site.products') @else
                            products @endif </label>
                    <select name="products_id" class="form-control">
                        @foreach( $products as $product)
                        <option value="{{ $product->id }}"> {{ $product->name }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">@if(app()->getLocale() == 'ar') @lang('site.quantity') @else
                            quantity @endif </label>
                    <input type="number" class="form-control" name="quantity" >
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">@if(app()->getLocale() == 'ar') @lang('site.clients') @else
                            Clients @endif </label>
                    <select name="client_id" class="form-control">
                        @foreach( $clients as $client)
                        <option value="{{ $client->id  }}">{{ $client->name }}</option>
                            @endforeach
                    </select>
                </div>


                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">@if(app()->getLocale() == 'ar')@lang('site.add') @else
                            Add @endif</button>
                </div>
        </form>
    </div>

@endsection