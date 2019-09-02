<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/16/2019 05:46 PM
 */
?>

@extends('layouts.admin.main')
@section('title', __('Permission'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.core.role.index') }}">{{ __('Role') }}</a>
    </li>
@endsection

@section('action_title')
    <a href="{{ route('admin.core.role.index') }}" class="btn btn-primary" title="{{ __('Role') }}">
        <i class="fa fa-arrow-left"></i>
        {{ __('Permission') }}
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>{{ __('Permission') }}</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{ route('admin.core.permission.role') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="user">{{ __('User') }}</label>
                            <select name="user_id" id="user" class="form-control" required>
                                <option value="">Vui lòng chọn thành viên</option>
                                @if ($users->isNotEmpty())
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="mt-5">
                            <h4>Nhóm quyền</h4>
                            <div class="roles">
                                @if ($roles->isNotEmpty())
                                    <div class="row">
                                        @foreach($roles as $role)
                                            <div class="col-md-4 col-sm-3 col-2">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="checkbox" id="role_{{$role->role_id}}" {{  old('role') && in_array($role->role_id, old('role')) ? 'checked' : '' }} name="role[]" value="{{ $role->role_id }}">
                                                        {{ $role->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-center text-danger">Không có dữ liệu</p>
                                @endif
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <a href="{{ route('admin.core.permission.index') }}" class="btn btn-danger">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/user.js') }}" type="text/javascript"></script>
@endsection

