@extends('layouts.dashboard.app')

@section('head')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">@if(app()->getLocale() == 'ar') @lang('site.dashboard') @else Home @endif </a></li>
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.index') }}"> @if(app()->getLocale() == 'ar') @lang('site.categories') @else categories @endif </a></li>
        </ol>
    </div>
    @endsection

@section('title')
    <h1 class="display-4">@if(app()->getLocale() == 'ar') @lang('site.categories') @else categories @endif</h1>
    @endsection
@section('content')

    <div class="col card">
        <div class="card-header">
            <h3 class="card-title">@if(app()->getLocale() == 'ar') @lang('site.allcategories') @else All categories @endif <small class="btn btn-secondary btn-sm disabled"> {{ $categories->total() }} </small></h3>
             <br>
               <form action="{{ route('dashboard.categories.index') }}" method="get">
                   <div class="row mt-3">
                   <input type="text" name="search" value="{{ request()->search }}" @if(app()->getLocale() == 'ar') placeholder="@lang('site.search')" @else placeholder="Search" @endif  class="col col-4 form-control">
                   <button type="submit" class="mr-3 btn btn-primary">@if(app()->getLocale() == 'ar') @lang('site.search') @else Search @endif </button>
                       @if(auth()->user()->hasPermission('create_categories'))
                       <a href="{{ route('dashboard.categories.create') }}" class="btn btn-info">@if(app()->getLocale() == 'ar')@lang('site.add') @else Add @endif</a>
                       @else
                           <a href="{{ route('dashboard.categories.create') }}" class="btn btn-info disabled">@if(app()->getLocale() == 'ar')@lang('site.add') @else Add @endif</a>

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
            @if( $categories->count() > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.name') @else  Name @endif </th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.product_count') @else  Product Count @endif </th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.related_products') @else  related product @endif </th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.action') @else Action @endif </th>

                    </tr>
                    </thead>
                    <tbody>
                     @foreach( $categories as $index => $category)
                         <tr>
                             <td>{{ $index + 1 }}</td>
                             <td>{{ $category->name }}</td>
                             <td>{{ $category->products->count() }}</td>
                             <td>
                                 <a href="{{route('dashboard.products.index',[ 'category_id'=> $category->id  ])}}" class="btn btn-success btn-sm">@if(app()->getLocale() == 'ar')  @lang('site.related_products') @else  related product @endif </a>
                             </td>


                             <td>
                                 <div >
                                     @if(auth()->user()->hasPermission('update_categories'))
                                         <a href="{{ route('dashboard.categories.edit',[ $category->id ]) }}" class="btn btn-primary">@if(app()->getLocale() == 'ar') @lang('site.edit') @else Edit @endif</a>
                                     @else
                                         <a href="{{ route('dashboard.categories.edit',[ $category->id ]) }}" class="btn btn-primary disabled">@if(app()->getLocale() == 'ar') @lang('site.edit') @else Edit @endif</a>
                                     @endif
                                    @if(auth()->user()->hasPermission('delete_categories'))
                                         <form style="display:inline-block;" action="{{ route('dashboard.categories.destroy',[ $category->id ]) }}" method="post">
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
           {{ $categories->appends(request()->query())->links() }}
        </div>
    </div>

    @endsection