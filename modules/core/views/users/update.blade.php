<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/16/2019 05:46 PM
 */
?>

@extends('layouts.admin.main')
@section('title', __('Update: ') . $model->name)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.core.user.index') }}">{{ __('Users') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ __('Update') }}
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>{{ __('Create User') }}</h5>
                    <div class="ibox-tools">
                        <a href="{{ route('admin.core.user.index') }}" title="{{ __('Back To List') }}">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <a href="{{ route('admin.core.user.create') }}" title="{{ __('Create') }}">
                            <i class="fa fa-plus"></i>
                        </a>
                        @if ($model->id != \Illuminate\Support\Facades\Auth::user()->id)
                        <a href="{{ route('admin.core.user.delete', $model->id) }}" onclick="return cms.confirm(__('Are you sure remove this item'))" title="{{ __('Remove') }}">
                            <i class="fa fa-trash"></i>
                        </a>
                        @endif
                    </div>
                </div>
                <div class="ibox-content">
                    <form action="{{ route('admin.core.user.update', $model->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input type="email" class="form-control disabled" name="email" id="email" value="{{ $model->email }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $model->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm">{{ __('Password Confirm') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <label for="title">{{ __('User Title') }}</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $model->profile ? $model->profile->title : '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="gender">{{ __('Gender') }}</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="">{{ __('Please select your gender') }}</option>
                                        <option value="Male" {{ $model->profile && $model->profile->gender == 'Male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                        <option value="Female" {{ $model->profile && $model->profile->gender == 'Female' ? 'selected' : '' }} >{{ __('Female') }}</option>
                                        <option value="Unknown" {{ $model->profile && $model->profile->gender == 'Unknown' ? 'selected' : '' }} >{{ __('Unknown') }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">{{ __('Phone Number') }}</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $model->profile ? $model->profile->phone_number : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="is_active">
                                        <input type="checkbox" class="checkbox" name="is_active" id="is_active" value="1" {{ $model->is_active == 1 ? 'checked' : '' }} >
                                        {{ __('Is Active') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">{{ __('Save') }}</button>
                            <a href="{{ route('admin.core.user.index') }}" class="btn btn-white btn-sm">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

