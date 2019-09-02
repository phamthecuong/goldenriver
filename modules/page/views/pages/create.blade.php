@extends('layouts.admin.main')
@section('title', __('Create Page'))
@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.page.index') }}">
            <span>{{ __('Pages') }}</span>
        </a>
    </li>
@endsection
@section('action_title')
    <a href="{{ route('admin.page.index') }}" class="btn btn-white" title="{{ __('Back To List') }}">
        <i class="fas fa-arrow-left"></i>
        {{ __('Back To List') }}
    </a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ibox-primary">
                <div class="ibox-title">
                    <h5>{{ __('Create Page') }}</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{ route('admin.page.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">{{ __('Title') }}</label>
                                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="slug">{{ __('Slug') }}</label>
                                    <input type="text" id="slug" name="slug" value="{{ old('slug') }}" class="form-control">
                                    <div class="help-block">
                                        <span>Slug bao gồm các kỹ tự a-z_-, 0-9. Không bao gồm các ký tự đặc biệt</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea class="form-control tiny_mce" id="description" name="description">{{ old('description') }}</textarea>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label for="meta_title">{{ __('Meta Title') }}</label>
                                    <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">{{ __('Meta Description') }}</label>
                                    <input type="text" id="meta_description" name="meta_description" value="{{ old('meta_description') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="meta_keyword">{{ __('Meta Keyword') }}</label>
                                    <input type="text" id="meta_keyword" name="meta_keyword" value="{{ old('meta_keyword') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" value="1" name="is_active" class="checkbox" {{ old('is_active') ? 'checked' : '' }}>
                                        {{__('Active')}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">{{ __('Save') }}</button>
                            <a href="{{ route('admin.page.index') }}" class="btn btn-white btn-sm">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection