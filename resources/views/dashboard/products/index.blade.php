@extends('layouts.dashboard.app')

@section('head')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">@if(app()->getLocale() == 'ar') @lang('site.dashboard') @else Home @endif </a></li>
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.products.index') }}"> @if(app()->getLocale() == 'ar') @lang('site.products') @else products @endif </a></li>
        </ol>
    </div>
    @endsection

@section('title')
    <h1 class="display-4">@if(app()->getLocale() == 'ar') @lang('site.products') @else products @endif</h1>
    @endsection
@section('content')

    <div class="col card">
        <div class="card-header">
            <h3 class="card-title">@if(app()->getLocale() == 'ar') @lang('site.allproducts') @else All products @endif <small class="btn btn-secondary btn-sm disabled"> {{ $products->total() }} </small></h3>
             <br>
             <br>
               <form action="{{ route('dashboard.products.index') }}" method="get">
                   <div class="row mt-3">
                   <input type="text" name="search" value="{{ request()->search }}" @if(app()->getLocale() == 'ar') placeholder="@lang('site.search')" @else placeholder="Search" @endif  class="col col-4 form-control">
                     <select name="category_id" class="col col-4 form-control mr-3">
                         <option value="">@if(app()->getLocale() == 'ar') @lang('site.allcategories') @else All categories @endif </option>
                         @foreach( $categories as $category )
                         <option value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected':'' }}>{{ $category->name }}</option>
                             @endforeach
                     </select>
                       <button type="submit" class="mr-3 btn btn-primary">@if(app()->getLocale() == 'ar') @lang('site.search') @else Search @endif </button>
                       @if(auth()->user()->hasPermission('create_products'))
                       <a href="{{ route('dashboard.products.create') }}" class="btn btn-info">@if(app()->getLocale() == 'ar')@lang('site.add') @else Add @endif</a>
                       @else
                           <a href="{{ route('dashboard.products.create') }}" class="btn btn-info disabled">@if(app()->getLocale() == 'ar')@lang('site.add') @else Add @endif</a>

                       @endif
                   </div>
               </form>
        </div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                <h1>{{ session('success') }}</h1>
            </div>
            @endif
        <!-- /.card-header -->
        <div class="card-body">
            @if( $products->count() > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.name') @else  Name @endif </th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.description') @else  Description @endif </th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.category') @else  Category @endif </th>
                        <th class="text-center">@if(app()->getLocale() == 'ar')  @lang('site.image') @else  Image @endif </th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.purchase_price') @else  Purchase price @endif </th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.sale_price') @else  Sale price @endif </th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.stock') @else  Stock @endif </th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.profit_percent') @else  profit percent @endif </th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.action') @else Action @endif </th>
                    </tr>
                    </thead>
                    <tbody>
                     @foreach( $products as $index => $product)
                         <tr>
                             <td>{{ $index + 1 }}</td>
                             <td>{{ $product->name }}</td>
                             <td>{!! $product->description !!}</td>
                             <td>{{ $product->category->name }}</td>
                             <td>
                                 <img src="/uploads/products_img/{{ $product->image }}" style="width: 100px;">
                             </td>
                             <td>{{ $product->purchase_price }}</td>
                             <td>{{ $product->sale_price }}</td>
                             <td>{{ $product->stock }}</td>
                             <td> {{ $product->getProfitPercent() }} %</td>

                             <td>
                                 <div >
                                     @if(auth()->user()->hasPermission('update_products'))
                                         <a href="{{ route('dashboard.products.edit',[ $product->id ]) }}" class="btn btn-primary">@if(app()->getLocale() == 'ar') @lang('site.edit') @else Edit @endif</a>
                                     @else
                                         <a href="{{ route('dashboard.products.edit',[ $product->id ]) }}" class="btn btn-primary disabled">@if(app()->getLocale() == 'ar') @lang('site.edit') @else Edit @endif</a>
                                     @endif
                                    @if(auth()->user()->hasPermission('delete_products'))
                                         <form style="display:inline-block;" action="{{ route('dashboard.products.destroy',[ $product->id ]) }}" method="post">
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
                @else
                <h1 class="display-4">@if(app()->getLocale() == 'ar')@lang('site.no_data_found') @else No data found @endif</h1>
            @endif
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
           {{ $products->appends(request()->query())->links() }}
        </div>
    </div>

    @endsection