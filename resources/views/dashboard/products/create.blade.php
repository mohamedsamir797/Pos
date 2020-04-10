@extends('layouts.dashboard.app')

@section('title')
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <h1 class="display-4">@if(app()->getLocale() == 'ar') @lang('site.products') @else products @endif</h1>
@endsection

@section('head')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">@if(app()->getLocale() == 'ar') @lang('site.dashboard') @else Home @endif </a></li>
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.products.index') }}"> @if(app()->getLocale() == 'ar') @lang('site.products') @else products @endif </a></li>
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.products.create') }}"> @if(app()->getLocale() == 'ar') @lang('site.add') @else Add @endif </a></li>

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
        <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="card-body">

                <div class="form-group">
                    <label for="exampleInputEmail1">@if(app()->getLocale() == 'ar') @lang('site.categories') @else categories @endif </label>
                    <select class="form-control" name="category_id" >
                        <option>@if(app()->getLocale() == 'ar') @lang('site.allcategories') @else All Categories @endif</option>
                        @foreach( $categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected': '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">@if(app()->getLocale() == 'ar') @lang('site.name') @else name @endif </label>
                    <input type="text" class="form-control" name="name" value="{{ @old('name') }}">
                </div>

            @foreach(config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label for="exampleInputEmail1">@if(app()->getLocale() == 'ar') @lang('site.'.$locale.'.description') @else description @endif </label>
                        <textarea  class="form-control ckeditor" name="{{ $locale }}[description]"  > {{ @old($locale.'.description')}}</textarea>
                    </div>
                @endforeach

                <div class="form-group">
                    <label >@if(app()->getLocale() == 'ar') @lang('site.image') @else Image @endif </label>
                    <input type="file" class="form-control" name="image" value="{{ @old('image') }}">
                </div>

                <div class="form-group">
                    <label >@if(app()->getLocale() == 'ar') @lang('site.purchase_price') @else purchase price @endif </label>
                    <input type="number" class="form-control" name="purchase_price" value="{{ @old('purchase_price') }}">
                </div>

                <div class="form-group">
                    <label >@if(app()->getLocale() == 'ar') @lang('site.sale_price') @else sale price @endif </label>
                    <input type="number" class="form-control" name="sale_price" value="{{ @old('sale_price') }}">
                </div>

                <div class="form-group">
                    <label >@if(app()->getLocale() == 'ar') @lang('site.stock') @else stock @endif </label>
                    <input type="number" class="form-control" name="stock" value="{{ @old('stock') }}">
                </div>


            <div class="card-footer">
                <button type="submit" class="btn btn-primary">@if(app()->getLocale() == 'ar')@lang('site.add') @else Add @endif</button>
            </div>
        </form>
    </div>

    @endsection