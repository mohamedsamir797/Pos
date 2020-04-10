
<div class="text-left" style="font-size: 18px;margin-right: 20px;">
    <a href="{{ route('dashboard.index') }}"> <i class="fas fa-th-large ml-2"></i>  @if(app()->getLocale() == 'ar') @lang('site.dashboard') @else Dashboard @endif </a><br>
    <hr>
    @if(auth()->user()->hasPermission('read_categories'))
        <a href="{{ route('dashboard.categories.index') }}"> <i class="fas fa-th-large ml-2"></i>  @if(app()->getLocale() == 'ar') @lang('site.categories') @else categories @endif </a>
    @endif
    <hr>
    @if(auth()->user()->hasPermission('read_products'))
        <a href="{{ route('dashboard.products.index') }}"> <i class="fas fa-th-large ml-2"></i>  @if(app()->getLocale() == 'ar') @lang('site.products') @else products @endif </a>
    @endif
    <hr>
    @if(auth()->user()->hasPermission('read_clients'))
        <a href="{{ route('dashboard.clients.index') }}"> <i class="fas fa-th-large ml-2"></i>  @if(app()->getLocale() == 'ar') @lang('site.clients') @else clients @endif </a>
    @endif
    <hr>
    @if(auth()->user()->hasPermission('read_orders'))
        <a href="{{ route('dashboard.orders.index') }}"> <i class="fas fa-th-large ml-2"></i>  @if(app()->getLocale() == 'ar') @lang('site.orders') @else orders @endif </a>
    @endif
    <hr>
    @if(auth()->user()->hasPermission('read_users'))
    <a href="{{ route('dashboard.users.index') }}"> <i class="fas fa-th-large ml-2"></i>  @if(app()->getLocale() == 'ar') @lang('site.users') @else Users @endif </a>
    @endif

</div>