@extends('layouts.admin.main')
@section('title', $model->title)

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
    <a href="{{ route('admin.page.create') }}" class="btn btn-primary" title="{{ __('Create Page') }}">
        <i class="fa fa-plus"></i>
        {{ __('Create Page') }}
    </a>
    <a href="{{ route('admin.page.edit', $model->page_id) }}" class="btn btn-primary" title="{{ __('Update') }}">
        <i class="fa fa-pencil-alt"></i>
        {{ __('Update') }}
    </a>
    <a href="javascript:void(0)" title="{{ __('Delete') }}" class="btn btn-danger" onclick="return cms.confirm('Bạn có chắc là muốn xóa mục này?') ? $('#remove_page').submit() : false">
        <i class="fa fa-trash"></i>
        {{ __('Delete') }}
    </a>
    <form action="{{ route('admin.page.delete', $model->page_id) }}" id="remove_page" method="post">
        @csrf
    </form>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ibox-primary">
                <div class="ibox-title">
                    <h5>{{ __('Pages') }}</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <td width="10%">{{ __('Title') }}</td>
                                <td>{{ $model->title }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Slug') }}</td>
                                <td>{{ $model->slug }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Description') }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($model->description, 150) }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Active') }}</td>
                                <td>{{ $model->is_active ? __('Yes') : __('No') }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Meta Title') }}</td>
                                <td>{{ $model->meta_title }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Meta Description') }}</td>
                                <td>{{ $model->meta_description }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Meta Keyword') }}</td>
                                <td>{{ $model->meta_keyword }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Created At') }}</td>
                                <td>{{ $model->created_at->diffForHumans() }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Created By') }}</td>
                                <td>{{ $model->createdBy ? $model->createdBy->name : '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection