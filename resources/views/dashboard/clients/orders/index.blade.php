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
        </ol>
    </div>
@endsection

@section('content')
    <div class="col card">
        <div class="card-header">
            <h3 class="card-title">@if(app()->getLocale() == 'ar') @lang('site.allorders') @else All orders @endif <small class="btn btn-secondary btn-sm disabled"> {{ $orders->total() }} </small></h3>
            <br>
            <form action="{{ route('dashboard.orders.index') }}" method="get">
                <div class="row mt-3">
                    <input type="text" name="search" value="{{ request()->search }}" @if(app()->getLocale() == 'ar') placeholder="@lang('site.search')" @else placeholder="Search" @endif  class="col col-4 form-control">
                    <button type="submit" class="mr-3 btn btn-primary">@if(app()->getLocale() == 'ar') @lang('site.search') @else Search @endif </button>
                    @if(auth()->user()->hasPermission('create_orders'))
                        <a href="{{ route('dashboard.orders.create') }}" class="btn btn-info">@if(app()->getLocale() == 'ar')@lang('site.add') @else Add @endif</a>
                    @else
                        <a href="{{ route('dashboard.orders.create') }}" class="btn btn-info disabled">@if(app()->getLocale() == 'ar')@lang('site.add') @else Add @endif</a>
                    @endif
                </div>
            </form>
        </div>
        <div class="col col-11 card card-info">
            <div class="card-header">
                <h3 class="card-title">@if(app()->getLocale() == 'ar') @lang('site.orders') @else orders @endif</h3>
            </div>
            <!-- form start -->
            <div class="col card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th >#</th>
                            <th>@if(app()->getLocale() == 'ar') @lang('site.name') @else name @endif</th>
                            <th>@if(app()->getLocale() == 'ar') @lang('site.products') @else products @endif</th>
                            <th>@if(app()->getLocale() == 'ar') @lang('site.orders') @else orders @endif</th>
                            <th>@if(app()->getLocale() == 'ar') @lang('site.quantity') @else quantity @endif</th>
                            <th >@if(app()->getLocale() == 'ar') @lang('site.price') @else price @endif</th>
                            <th >@if(app()->getLocale() == 'ar') @lang('site.action') @else action @endif</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $orders as $index => $order)
                        <tr>
                            <td>{{ $index +1 }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->client->name }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->product->sale_price }}</td>
                            <td>
                                <div >
                                    @if(auth()->user()->hasPermission('update_orders'))
                                        <a href="{{ route('dashboard.orders.edit',[ $order->id ]) }}" class="btn btn-primary">@if(app()->getLocale() == 'ar') @lang('site.edit') @else Edit @endif</a>
                                    @else
                                        <a href="{{ route('dashboard.orders.edit',[ $order->id ]) }}" class="btn btn-primary disabled">@if(app()->getLocale() == 'ar') @lang('site.edit') @else Edit @endif</a>
                                    @endif
                                    @if(auth()->user()->hasPermission('delete_products'))
                                        <form style="display:inline-block;" action="{{ route('dashboard.orders.destroy',[ $order->id ]) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">@if(app()->getLocale() == 'ar')@lang('site.delete') @else Delete @endif</button>
                                        </form>
                                    @else
                                        <a class="btn btn-danger disabled">@if(app()->getLocale() == 'ar')@lang('site.delete') @else Delete @endif</a>
                                    @endif
                                </div>
                            </td>

                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection