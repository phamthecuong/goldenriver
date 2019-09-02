<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/16/2019 05:46 PM
 */
?>

@extends('layouts.admin.main')
@section('title', __('Create Role'))

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.core.role.index') }}">{{ __('Role') }}</a>
    </li>
@endsection

@section('action_title')
    <a href="{{ route('admin.core.role.index') }}" class="btn btn-white" title="{{ __('Back To List') }}">
        <i class="fa fa-arrow-left"></i>
        {{ __('Back To List') }}
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>{{ __('Create Role') }}</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{ route('admin.core.role.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            <a href="{{ route('admin.core.user.index') }}" class="btn btn-white">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

