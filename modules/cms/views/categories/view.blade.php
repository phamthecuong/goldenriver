@extends('layouts.admin.main')
@section('title', $model->title)

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.cms.category.index') }}">{{ __('Category') }}</a>
    </li>
@endsection

@section('action_title')
    <a href="{{ route('admin.cms.category.create') }}" class="btn btn-primary" title="{{ __('Create') }}">
        <i class="fa fa-plus"></i>
        {{ __('Create') }}
    </a>
    <a href="{{ route('admin.cms.category.edit', $model->category_id) }}" class="btn btn-primary" title="{{ __('Update') }}">
        <i class="fas fa-pencil-alt"></i>
        {{ __('Update') }}
    </a>
    <a href="{{ route('admin.cms.category.delete', $model->category_id) }}" onclick="return cms.confirm('Bạn có chắc là muốn xóa mục này?')" title="{{ __('Delete') }}" class="btn btn-danger">
        <i class="fas fa-trash"></i>
        {{ __('Delete') }}
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>{{ $model->title }}</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <td style="width: 15%">{{ __('Title') }}</td>
                                <td>{{ $model->title }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Slug') }}</td>
                                <td>{{ $model->slug }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Description') }}</td>
                                <td>{{ $model->description }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Parent') }}</td>
                                <td>{!!  $model->getParent ? "<a href='".route('admin.cms.category.view', $model->getParent->category_id)."' title='{$model->getParent->title}'>{$model->getParent->title}</a>": ''  !!}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Published') }}</td>
                                <td>{{ $model->published_f ? __('Active') : __('Deactivate') }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Created At') }}</td>
                                <td>{{ $model->created_at->diffForHumans()}}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Created By') }}</td>
                                <td>{{ $model->userCreated ? $model->userCreated->name : ''}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection