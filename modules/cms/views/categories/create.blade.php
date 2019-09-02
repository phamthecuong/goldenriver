@extends('layouts.admin.main')
@section('title', __('Create Category'))
@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.cms.category.index') }}">{{ __('Category') }}</a>
    </li>
@endsection

@section('action_title')
    <a href="{{ route('admin.cms.category.index') }}" class="btn btn-white" title="{{ __('Back To List') }}">
        <i class="fa fa-arrow-left"></i>
        {{ __('Back To List') }}
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>{{ __('Create Category') }}</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{ route('admin.cms.category.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" value="{{ old('title') }}" id="title" name="title" placeholder="Tiêu đề">
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea name="description" id="description" class="form-control" rows="6">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="parent">{{ __('Parent Category') }}</label>
                                    <select name="parent_id" id="parent" class="form-control">
                                        <option value="0">{{ __('Please select parent category') }}</option>

                                        @if (!empty($categories = \Modules\cms\models\Category::getInstant()->buildCategoryTree()))
                                            @foreach($categories as $category)
                                                <option value="{{ $category['category_id'] }}" {{ old('parent_id') == $category['category_id'] ? 'selected' : '' }}>{{ $category['title'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="published_f" value="1" {{ old('published_f') == 1 ? 'checked' : '' }} class="i-checks">
                                        {{ __('Published') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">{{ __('Save') }}</button>
                            <a href="{{ route('admin.cms.category.index') }}" class="btn btn-white btn-sm">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection