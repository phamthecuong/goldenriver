<?php
/**
 * Author Kết NV.
 * Email: vanket90@gmail.com
 * Create At: 05/16/2019 05:46 PM
 */
?>

@extends('layouts.admin.main')
@section('title', __('Update: ') . $model->title)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.core.nav.index') }}">{{ __('Navigation') }}</a>
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
                    </div>
                </div>
                <div class="ibox-content">
                    <form action="{{ route('admin.core.nav.update', $model->navigation_id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">{{ __('Title') }}</label>
                                    <input type="text" id="title" name="title" value="{{ $model->title }}" class="form-control" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="url">{{ __('Url') }}</label>
                                    <input type="text" id="url" name="url" value="{{$model->url }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="group">Nhóm menu</label>
                                    <select name="group" id="group" class="form-control">
                                        <option value="">Vui lòng chọn nhóm</option>
                                        <option value="{{ \Modules\core\models\Navigation::GROUP_HEADER }}" {{ $model->group == \Modules\core\models\Navigation::GROUP_HEADER ? 'selected' : '' }}>{{ __('Header') }}</option>
                                        <option value="{{ \Modules\core\models\Navigation::GROUP_FOOTER }}" {{ $model->group == \Modules\core\models\Navigation::GROUP_FOOTER ? 'selected' : '' }}>{{ __('Footer') }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="parent">Menu cha</label>
                                    <select name="parent_id" id="parent" class="form-control">
                                        <option value="0">Vui lòng menu cha</option>
                                        @if(!empty($navigations = \Modules\core\models\Navigation::getInstance()->buildNavTree()))
                                            @foreach($navigations as $navigation)
                                                <option value="{{ $navigation['navigation_id'] }}" {{ $model->parent_id == $navigation['navigation_id'] ? 'selected' : '' }}>{{ $navigation['title'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="is_active">
                                        <input type="checkbox" class="checkbox" name="is_active" id="is_active" value="1" {{ $model->is_active == \App\Constants\AppConstants::CHECKED ? 'checked' : '' }} >
                                        {{ __('Is Active') }}
                                    </label>
                                </div>
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

