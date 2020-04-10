@extends('layouts.dashboard.app')

@section('head')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">@if(app()->getLocale() == 'ar') @lang('site.dashboard') @else Home @endif </a></li>
            <li class="breadcrumb-item active"><a href="{{ route('dashboard.users.index') }}"> @if(app()->getLocale() == 'ar') @lang('site.users') @else Users @endif </a></li>
        </ol>
    </div>
    @endsection

@section('title')
    <h1 class="display-4">@if(app()->getLocale() == 'ar') @lang('site.users') @else users @endif</h1>
    @endsection
@section('content')

    <div class="col card">
        <div class="card-header">
            <h3 class="card-title">@if(app()->getLocale() == 'ar') @lang('site.alluser') @else All Users @endif <small class="btn btn-secondary btn-sm disabled"> {{ $users->total() }} </small></h3>
             <br>
               <form action="{{ route('dashboard.users.index') }}" method="get">
                   <div class="row mt-3">
                   <input type="text" name="search" value="{{ request()->search }}" @if(app()->getLocale() == 'ar') placeholder="@lang('site.search')" @else placeholder="Search" @endif  class="col col-4 form-control">
                   <button type="submit" class="mr-3 btn btn-primary">@if(app()->getLocale() == 'ar') @lang('site.search') @else Search @endif </button>
                       @if(auth()->user()->hasPermission('create_users'))
                       <a href="{{ route('dashboard.users.create') }}" class="btn btn-info">@if(app()->getLocale() == 'ar')@lang('site.add') @else Add @endif</a>
                       @else
                           <a href="{{ route('dashboard.users.create') }}" class="btn btn-info disabled">@if(app()->getLocale() == 'ar')@lang('site.add') @else Add @endif</a>

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
            @if( $users->count() > 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.first_name') @else First Name @endif </th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.last_name') @else Last Name @endif </th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.email') @else Email @endif </th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.image') @else Image @endif </th>
                        <th>@if(app()->getLocale() == 'ar')  @lang('site.action') @else Action @endif </th>
                    </tr>
                    </thead>
                    <tbody>
                     @foreach( $users as $index => $user)
                         <tr>
                             <td>{{ $index + 1 }}</td>
                             <td>{{ $user->first_name }}</td>
                             <td>{{ $user->last_name }}</td>
                             <td>{{ $user->email }}</td>
                             <td>
                                 <img src="/uploads/users_img/{{ $user->image }}" style="width: 100px">
                             </td>
                             <td>
                                 <div >
                                     @if(auth()->user()->hasPermission('update_users'))
                                         <a href="{{ route('dashboard.users.edit',[ $user->id ]) }}" class="btn btn-primary">@if(app()->getLocale() == 'ar') @lang('site.edit') @else Edit @endif</a>
                                     @else
                                         <a href="{{ route('dashboard.users.edit',[ $user->id ]) }}" class="btn btn-primary disabled">@if(app()->getLocale() == 'ar') @lang('site.edit') @else Edit @endif</a>
                                     @endif
                                    @if(auth()->user()->hasPermission('delete_users'))
                                         <form style="display:inline-block;" action="{{ route('dashboard.users.destroy',[ $user->id ]) }}" method="post">
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
           {{ $users->appends(request()->query())->links() }}
        </div>
    </div>

    @endsection