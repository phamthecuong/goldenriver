<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/16/2019 05:46 PM
 */
?>

@extends('layouts.admin.main')
@section('title', __('Users'))
@section('action_title')
    <a href="{{ route('admin.core.user.create') }}" class="btn btn-primary" title="{{ __('Create') }}">
        <i class="fa fa-plus"></i>
        {{ __('Create') }}
    </a>
    <a href="{{ route('admin.core.user.index') }}" class="btn btn-white" title="{{ __('Reset Filter') }}">
        <i class="fa fa-sync"></i>
        {{ __('Reset Filter') }}
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('core::users.includes.__filter_form')
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>{{ __('Users') }}</h5>
                </div>
                <div class="ibox-content">
                    @if($users->isNotEmpty())
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('name', 'admin.core.user.index', $params, __('Name')) !!}
                                </th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('email', 'admin.core.user.index', $params) !!}
                                </th>
                                <th>{{ __('Phone Number') }}</th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('is_active', 'admin.core.user.index', $params, __('Is Active')) !!}
                                </th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('created_at', 'admin.core.user.index', $params, __('Created At')) !!}
                                </th>
                                <th class="text-right" style="width: 100px;">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td><a href="{{ route('admin.core.user.view', $user->id) }}" title="{{ $user->name }}">{{ $user->name }}</a></td>
                                    <td><a href="mailto:{{$user->email}}">{{ $user->email }}</a></td>
                                    <td>
                                        @if ($user->profile && $user->profile->phone_number)
                                            <a href="tel:{{ $user->profile->phone_number }}">{{ $user->profile->phone_number }}</a>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('admin.core.user.state', $user->id) }}">{!! $user->is_active ? '<i class="fa fa-check"></i>' : '<i class="fa fa-check text-muted"></i>' !!}</a></td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td class="text-right footable-visible footable-last-column">
                                        <div class="btn-group">
                                            <a class="btn-primary btn btn-xs" href="{{ route('admin.core.user.view', $user->id) }}" title="{{ __('View') }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a class="btn-primary btn btn-xs" href="{{ route('admin.core.user.edit', $user->id) }}" title="{{ __('Update') }}">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            @if ($user->id !== \Illuminate\Support\Facades\Auth::user()->id)
                                                <a class="btn-danger btn btn-xs" href="{{ route('admin.core.user.delete', $user->id) }}" onclick="return cms.confirm('Bạn có chắc muốn xóa người dùng này không?')" title="{{ __('Delete') }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $users->links() }}
                    @else
                        <p class="text-center text-danger">Đang cập nhật dữ liệu</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

