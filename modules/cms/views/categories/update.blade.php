@extends('layouts.admin.main')
@section('title', __('Update: ') . $model->title)
@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.cms.category.index') }}">{{ __('Category') }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ __('Update') }}
    </li>
@endsection

@section('action_title')
    <a href="{{ route('admin.cms.category.index') }}" class="btn btn-white" title="{{ __('Back To List') }}">
        <i class="fa fa-arrow-left"></i>
        {{ __('Back To List') }}
    </a>
    <a href="{{ route('admin.cms.category.delete', $model->category_id) }}" onclick="return cms.confirm('Bạn có chắc là muốn xóa mục này?')" title="{{ __('Delete') }}" class="btn btn-danger">
        <i class="fa fa-trash"></i>
        {{ __('Delete') }}
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>{{ __('Update: ') . $model->title }}</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{ route('admin.cms.category.update', $model->category_id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">{{ __('Title') }}</label>
                                    <input type="text" class="form-control" value="{{ $model->title }}" id="title" name="title" placeholder="Tiêu đề">
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea name="description" id="description" class="form-control" rows="6">{{ $model->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="parent">{{ __('Parent Category') }}</label>
                                    <select name="parent_id" id="parent" class="form-control">
                                        <option value="0">{{ __('Please select parent category') }}</option>

                                        @if (!empty($categories = \Modules\cms\models\Category::getInstant()->buildCategoryTree()))
                                            @foreach($categories as $category)
                                                <option value="{{ $category['category_id'] }}" {{ $model->parent_id == $category['category_id'] ? 'selected' : '' }}>{{ $category['title'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="published_f" value="1" {{ $model->published_f == 1 ? 'checked' : '' }} class="i-checks">
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