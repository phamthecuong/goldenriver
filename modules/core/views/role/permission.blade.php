<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/16/2019 05:46 PM
 */
?>

@extends('layouts.admin.main')
@section('title', __('Permission') . ': ' . $model->name)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.core.role.index') }}">{{ __('Role') }}</a>
    </li>
@endsection

@section('action_title')
    <a href="{{ route('admin.core.role.index') }}" class="btn btn-primary" title="{{ __('Role') }}">
        <i class="fa fa-arrow-left"></i>
        {{ __('Role') }}
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>{{ __('Roles') }}: {{ $model->name }}</h5>
                </div>
                <div class="ibox-content">
                    @if($permissionGroup->isNotEmpty())
                        <form action="{{ route('admin.core.role.addPermission', $model->role_id) }}" method="post">
                            @csrf
                            <table class="table table-bordered table-hover table-striped">
                                <tbody>
                                    @foreach($permissionGroup as $group)
                                        <tr>
                                            <td colspan="3">
                                                <strong>{{ $group->title }}</strong>
                                            </td>
                                        </tr>

                                        @if($group->getPermission)
                                            @foreach($group->getPermission as $permission)
                                                <tr>
                                                    <td>{{ $permission->description }}</td>
                                                    <td class="bg-primary text-center">
                                                        <label for="">
                                                            <input type="radio" {{ $model->permissions->whereIn('name', $permission->name)->isNotEmpty() ? 'checked' : '' }} name="permission[{{ $permission->name }}]" value="1" id="set_{{ $permission->name }}">
                                                            {{ __('Allow') }}
                                                        </label>
                                                    </td>
                                                    <td class="bg-danger text-center">
                                                        <label for="">
                                                            <input type="radio" {{ $model->permissions->whereIn('name', $permission->name)->isEmpty() ? 'checked' : '' }} name="permission[{{ $permission->name }}]" value="0" id="unset_{{ $permission->name }}">
                                                            {{ __('Deny') }}
                                                        </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Lưu</button>
                                <a href="{{ route('admin.core.role.index') }}" class="btn btn-default">Hủy</a>
                            </div>
                        </form>
                    @else
                        <p class="text-center text-danger">Đang cập nhật dữ liệu</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

