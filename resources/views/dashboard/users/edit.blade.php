@extends('layouts.dashboard.app')

@section('title')
    <h1 class="display-4">@if(app()->getLocale() == 'ar') @lang('site.edit') @else Edit @endif</h1>
@endsection

@section('head')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">@if(app()->getLocale() == 'ar') @lang('site.dashboard') @else Home @endif </a></li>
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.users.index') }}"> @if(app()->getLocale() == 'ar') @lang('site.users') @else Users @endif </a></li>
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.users.edit',[$user->id]) }}"> @if(app()->getLocale() == 'ar') @lang('site.edit') @else Edit @endif </a></li>
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
        <form action="{{ route('dashboard.users.update',[$user->id]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('put') }}
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">@if(app()->getLocale() == 'ar') @lang('site.first_name') @else first name @endif </label>
                    <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">@if(app()->getLocale() == 'ar') @lang('site.last_name') @else last name @endif </label>
                    <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">@if(app()->getLocale() == 'ar') @lang('site.email') @else Email @endif </label>
                    <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                </div>

                <div class="form-group">
                    <label >@if(app()->getLocale() == 'ar') @lang('site.image') @else Image @endif </label>
                    <input type="file" class="form-control" name="image" value="{{ @old('image') }}">
                </div>

                <div class="form-group">
                    <img src="/uploads/{{ $user->image }}" style="width: 100px;">
                </div>

                <div class="card">
                    <div class="card-header d-flex p-0">
                        <h1 class="card-title p-3">@if(app()->getLocale() == 'ar')@lang('site.permission') @else Permissions @endif</h1>
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><a class="nav-link active" href="#users" data-toggle="tab">@if(app()->getLocale() == 'ar')@lang('site.users') @else Users @endif</a></li>
                            <li class="nav-item"><a class="nav-link" href="#products" data-toggle="tab">@if(app()->getLocale() == 'ar')@lang('site.products') @else products @endif</a></li>
                            <li class="nav-item"><a class="nav-link" href="#categories" data-toggle="tab">@if(app()->getLocale() == 'ar')@lang('site.categories') @else categories @endif</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="users">
                                <div class="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="create_users" @if($user->hasPermission('create_users')) checked @endif>
                                        <label class="form-check-label mr-3">@if(app()->getLocale() == 'ar') @lang('site.create') @else Create @endif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="read_users" @if($user->hasPermission('read_users')) checked @endif>
                                        <label class="form-check-label mr-3">@if(app()->getLocale() == 'ar') @lang('site.read') @else Read @endif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="update_users" @if($user->hasPermission('update_users')) checked @endif>
                                        <label class="form-check-label mr-3">@if(app()->getLocale() == 'ar') @lang('site.update') @else update @endif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="delete_users" @if($user->hasPermission('delete_users')) checked @endif>
                                        <label class="form-check-label mr-3">@if(app()->getLocale() == 'ar') @lang('site.delete') @else delete @endif</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="products">
                                <div class="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" >
                                        <label class="form-check-label mr-3">@if(app()->getLocale() == 'ar') @lang('site.create') @else Create @endif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label mr-3">@if(app()->getLocale() == 'ar') @lang('site.read') @else Read @endif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label mr-3">@if(app()->getLocale() == 'ar') @lang('site.update') @else update @endif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label mr-3">@if(app()->getLocale() == 'ar') @lang('site.delete') @else delete @endif</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="categories">

                                <div class="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label mr-3">@if(app()->getLocale() == 'ar') @lang('site.create') @else Create @endif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label mr-3">@if(app()->getLocale() == 'ar') @lang('site.read') @else Read @endif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label mr-3">@if(app()->getLocale() == 'ar') @lang('site.update') @else update @endif</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label mr-3">@if(app()->getLocale() == 'ar') @lang('site.delete') @else delete @endif</label>
                                    </div>
                                </div>

                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">@if(app()->getLocale() == 'ar')@lang('site.add') @else Add @endif</button>
            </div>
        </form>
    </div>

@endsection