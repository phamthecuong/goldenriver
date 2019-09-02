@extends('layouts.admin.main')
@section('title', $model->name)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.core.user.index') }}">{{ __('Users') }}</a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>{{ $model->title }}</h5>
                    <div class="ibox-tools">
                        <a href="{{ route('admin.core.user.create') }}" title="{{ __('Create') }}">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a href="{{ route('admin.core.user.edit', $model->id) }}" title="{{ __('Update') }}">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        @if ($model->id != \Illuminate\Support\Facades\Auth::user()->id)
                        <a href="{{ route('admin.core.user.delete', $model->id) }}" onclick="return cms.confirm('Bạn có chắc là muốn xóa mục này?')" title="{{ __('Delete') }}" class="text-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                        @endif
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <td style="width: 15%">{{ __('Name') }}</td>
                                <td>{{ $model->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Email') }}</td>
                                <td><a href="mailto:{{$model->email}}">{{ $model->email }}</a></td>
                            </tr>
                            @if ($model->profile)
                                <tr>
                                    <td>{{ __('User Title') }}</td>
                                    <td>{{ __($model->profile->title) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Gender') }}</td>
                                    <td>{{ __($model->profile->gender) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Phone Number') }}</td>
                                    <td><a href="tel:{{ $model->profile->phone_number }}"></a>{{ $model->profile->phone_number }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>{{ __('Roles') }}</td>
                                <td>
                                    @if ($model->roles->isNotEmpty())
                                        @foreach($model->roles as $role)
                                            <a href="{{ route('admin.core.role.permission', $role->role_id) }}" title="{{ $role->name }}" class="d-inline-block mr-3">{{$role->name}}</a>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('Is Active') }}</td>
                                <td>
                                    {!! $model->is_active ? __('Active') : __('Deactivate') !!}
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('Created At') }}</td>
                                <td>{{ $model->created_at->diffForHumans() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection