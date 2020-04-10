@extends('layouts.dashboard.app')

@section('title')
    <h1 class="display-4">@if(app()->getLocale() == 'ar') @lang('site.edit') @else Edit @endif</h1>
@endsection

@section('head')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">@if(app()->getLocale() == 'ar') @lang('site.dashboard') @else Home @endif </a></li>
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.index') }}"> @if(app()->getLocale() == 'ar') @lang('site.categories') @else categories @endif </a></li>
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.edit',[$category->id]) }}"> @if(app()->getLocale() == 'ar') @lang('site.edit') @else Edit @endif </a></li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="col col-11 card card-info">
        <div class="card-header">
            <h3 class="card-title">@if(app()->getLocale() == 'ar') @lang('site.edit') @else Edit @endif</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @include('dashboard.allErorrs')
        <form action="{{ route('dashboard.categories.update',[$category->id]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="card-body">
                @foreach(config('translatable.locales') as $locale)
                    <div class="form-group">
                        <label for="exampleInputEmail1">@if(app()->getLocale() == 'ar') @lang('site.'.$locale.'.name') @else name @endif </label>
                        <input type="text" class="form-control" name="{{ $locale }}[name]" value="{{ $category->translate($locale)->name }}">
                    </div>
                @endforeach

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">@if(app()->getLocale() == 'ar')@lang('site.add') @else Add @endif</button>
            </div>
        </form>
    </div>

@endsection