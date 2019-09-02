@extends('layouts.admin.main')
@section('title', __('Create Post'))
@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.cms.post.index') }}">{{ __('Posts') }}</a>
    </li>
@endsection
@section('action_title')
    <a href="{{ route('admin.cms.post.index') }}" class="btn btn-white" title="{{ __('Back To List') }}">
        <i class="fa fa-arrow-left"></i>
        {{ __('Back To List') }}
    </a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>{{ __('Create Post') }}</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{ route('admin.cms.post.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">{{ __('Title') }}</label>
                                    <input type="text" class="form-control" value="{{ old('title') }}" id="title" name="title" placeholder="Tiêu đề" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea name="description" id="description" class="form-control" rows="2" required>{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="content">{{ __('Content') }}</label>
                                    <textarea name="content" id="content" class="form-control tiny_mce" rows="10" required>
                                        {{ old('content') }}
                                    </textarea>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label for="keyword">{{ __('Title') }}</label>
                                    <input type="text" name="meta_title" id="keyword" class="form-control" value="{{ old('meta_title') }}">
                                </div>
                                <div class="form-group">
                                    <label for="keyword">{{ __('Keyword') }}</label>
                                    <input type="text" name="meta_keyword" id="keyword" class="form-control" value="{{ old('meta_keyword') }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">{{ __('Description') }}</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control" rows="5">{{ old('meta_description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="avatar">{{ __('Thumbnail') }}</label>
                                    <input type="file" class="form-control-file" name="avatar" id="avatar" accept="image/*">
                                </div>

                                <div class="form-group">
                                    <label for="parent">{{ __('Category') }}</label>
                                    <select name="category_id" id="parent" class="form-control required" required>
                                        <option value="">{{ __('Please select category') }}</option>
                                        @if (!empty($categories = \Modules\cms\models\Category::getInstant()->buildCategoryTree()))
                                            @foreach($categories as $category)
                                                <option value="{{ $category['category_id'] }}" {{ old('category_id') == $category['category_id'] ? 'selected' : '' }}>{{ $category['title'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="is_feature" value="1" {{ old('is_feature') == 1 ? 'checked' : '' }} class="i-checks">
                                        {{ __('Feature') }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="published_f" value="1" {{ old('published_f') == 1 ? 'checked' : '' }} class="i-checks">
                                        {{ __('Active') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">{{ __('Save') }}</button>
                            <a href="{{ route('admin.cms.post.index') }}" class="btn btn-white btn-sm">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection