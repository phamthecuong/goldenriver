<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/16/2019 05:46 PM
 */
?>

@extends('layouts.admin.main')
@section('title', __('Roles'))
@section('action_title')
    <a href="{{ route('admin.core.role.create') }}" class="btn btn-primary" title="{{ __('Create') }}">
        <i class="fa fa-plus"></i>
        {{ __('Create') }}
    </a>
    <a href="{{ route('admin.core.role.index') }}" class="btn btn-white" title="{{ __('Reset Filter') }}">
        <i class="fa fa-sync"></i>
        {{ __('Reset Filter') }}
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('core::role.includes.__filter_form')
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>{{ __('Roles') }}</h5>
                </div>
                <div class="ibox-content">
                    @if($roles->isNotEmpty())
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('name', 'admin.core.role.index', $params, __('Name')) !!}
                                </th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('description', 'admin.core.role.index', $params) !!}
                                </th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('created_at', 'admin.core.role.index', $params, __('Created At')) !!}
                                </th>
                                <th class="text-right" style="width: 100px;">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $key => $role)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td><a href="{{ route('admin.core.role.view', $role->role_id) }}" title="{{ $role->name }}">{{ $role->name }}</a></td>
                                    <td>{{ $role->description }}</td>
                                    <td>{{ $role->created_at->diffForHumans() }}</td>
                                    <td class="text-right footable-visible footable-last-column">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.core.role.permission', $role->role_id) }}" class="btn btn-primary btn-xs" title="Phân quyền">
                                                <i class="fa fa-key"></i>
                                            </a>
                                            <a class="btn-primary btn btn-xs" href="{{ route('admin.core.role.view', $role->role_id) }}" title="{{ __('View') }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a class="btn-primary btn btn-xs" href="{{ route('admin.core.role.edit', $role->role_id) }}" title="{{ __('Update') }}">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            <a class="btn-danger btn btn-xs" href="{{ route('admin.core.role.delete', $role->role_id) }}" onclick="return cms.confirm('Bạn có chắc muốn xóa người dùng này không?')" title="{{ __('Delete') }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $roles->links() }}
                    @else
                        <p class="text-center text-danger">Đang cập nhật dữ liệu</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

