<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>@yield('title')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard.index') }}">{{ __('Dashboard') }}</a>
            </li>
            @yield('breadcrumbs')
            <li class="breadcrumb-item active">
                <strong>@yield('title')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="title-action">
            @yield('action_title')
        </div>
    </div>
</div>