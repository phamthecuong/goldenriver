<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/16/2019 05:46 PM
 */
?>

@extends('layouts.admin.main')
@section('title', __('Navigation'))
@section('action_title')
    <a href="{{ route('admin.core.nav.create') }}" class="btn btn-primary" title="{{ __('Create') }}">
        <i class="fa fa-plus"></i>
        {{ __('Create') }}
    </a>
    <a href="{{ route('admin.core.nav.index') }}" class="btn btn-white" title="{{ __('Reset Filter') }}">
        <i class="fa fa-sync"></i>
        {{ __('Reset Filter') }}
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('core::navigations.includes.__filter_form')
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>{{ __('Navigations') }}</h5>
                </div>
                <div class="ibox-content">
                    @if($navigations->isNotEmpty())
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('title', 'admin.core.nav.index', $params, __('Title')) !!}
                                </th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('url', 'admin.core.nav.index', $params) !!}
                                </th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('group', 'admin.core.nav.index', $params, __('Group')) !!}
                                </th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('parent_id', 'admin.core.nav.index', $params, __('Parent')) !!}
                                </th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('is_active', 'admin.core.nav.index', $params, __('Is Active')) !!}
                                </th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('created_at', 'admin.core.user.index', $params, __('Created At')) !!}
                                </th>
                                <th class="text-right" style="width: 100px;">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($navigations as $key => $navigation)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td><a href="{{ route('admin.core.nav.edit', $navigation->navigation_id) }}" title="{{ $navigation->title }}">{{ $navigation->title }}</a></td>
                                    <td><a href="{{ route('admin.core.nav.edit', $navigation->navigation_id) }}" title="{{ $navigation->url }}">{{ $navigation->url }}</a></td>
                                    <td>{{ $navigation->group == \Modules\core\models\Navigation::GROUP_HEADER ? 'Header' : 'Footer' }}</td>
                                    <td>{{ $navigation->getParent ? $navigation->getParent->title : '' }}</td>
                                    <td><a href="{{ route('admin.core.nav.toggle', $navigation->navigation_id) }}">{!! $navigation->is_active ? '<i class="fa fa-check"></i>' : '<i class="fa fa-check text-muted"></i>' !!}</a></td>
                                    <td>{{ $navigation->created_at->diffForHumans() }}</td>
                                    <td class="text-right footable-visible footable-last-column">
                                        <div class="btn-group">
                                            <a class="btn-primary btn btn-xs" href="{{ route('admin.core.nav.edit', $navigation->navigation_id) }}" title="{{ __('Update') }}">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                                <a class="btn-danger btn btn-xs" href="{{ route('admin.core.nav.delete', $navigation->navigation_id) }}" onclick="return cms.confirm('Bạn có chắc muốn xóa mục này không?')" title="{{ __('Delete') }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $navigations->links() }}
                    @else
                        <p class="text-center text-danger">Đang cập nhật dữ liệu</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

