@extends('layouts.admin.main')
@section('title', __('Categories'))
@section('action_title')
    <a href="{{ route('admin.cms.category.create') }}" class="btn btn-primary" title="{{ __('Create Category') }}">
        <i class="fa fa-plus"></i>
        {{ __('Create Category') }}
    </a>
    <a href="{{ route('admin.cms.category.index') }}" class="btn btn-white" title="{{ __('Reset Filter') }}">
        <i class="fas fa-sync"></i>
        {{ __('Reset Filter') }}
    </a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('cms::categories.includes.__filter_form')

            <div class="ibox">
                <div class="ibox-title">
                    <h5>{{ __('Categories') }}</h5>
                </div>
                <div class="ibox-content">
                    @if($categories->isNotEmpty())
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">#</th>
                                    <th>
                                        {!! \App\Helpers\SortableHelper::sortLink('title', 'admin.cms.category.index', $params, __('Title')) !!}
                                    </th>
                                    <th>{!! \App\Helpers\SortableHelper::sortLink('slug', 'admin.cms.category.index', $params) !!}</th>
                                    <th>
                                        {!! \App\Helpers\SortableHelper::sortLink('description', 'admin.cms.category.index', $params, __('Description')) !!}
                                    </th>
                                    <th>
                                        {!! \App\Helpers\SortableHelper::sortLink('parent_id', 'admin.cms.category.index', $params, __('Parent')) !!}
                                    </th>
                                    <th class="text-center" style="width: 150px;">
                                        {!! \App\Helpers\SortableHelper::sortLink('published_f', 'admin.cms.category.index', $params, __('Published')) !!}
                                    </th>
                                    <th>
                                        {!! \App\Helpers\SortableHelper::sortLink('created_at', 'admin.cms.category.index', $params, __('Created')) !!}
                                    </th>
                                    <th class="text-right" style="width: 100px;">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $key => $category)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td><a href="{{ route('admin.cms.category.view', $category->category_id) }}" title="{{ $category->title }}">{{ $category->title }}</a></td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($category->description, 50)  }}</td>
                                        <td>
                                            @if($category->getParent)
                                                <a href="{{ route('admin.cms.category.view', $category->parent_id) }}" title="{{ $category->category_id }}">{{ $category->getParent->title }}</a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($category->published_f)
                                                <a href="{{ route('admin.cms.category.state', $category->category_id) }}" title="{{ __('Active') }}"><i class=" fa fa-check"></i></a>
                                            @else
                                                <a href="{{ route('admin.cms.category.state', $category->category_id) }}" title="{{ __('Deactivate') }}" class="text-muted"><i class=" fa fa-check"></i></a>
                                            @endif
                                        </td>
                                        <td>{{ $category->created_at->diffForHumans() }}</td>
                                        <td class="text-right footable-visible footable-last-column">
                                            <div class="btn-group">
                                                <a class="btn-primary btn btn-xs" href="{{ route('admin.cms.category.view', $category->category_id) }}" title="{{ __('View') }}"><i class="fa fa-eye"></i></a>
                                                <a class="btn-primary btn btn-xs" href="{{ route('admin.cms.category.edit', $category->category_id) }}" title="{{ __('Update') }}"><i class="fa fa-pencil-alt"></i></a>
                                                <a class="btn-danger btn btn-xs" href="{{ route('admin.cms.category.delete', $category->category_id) }}" onclick="return cms.confirm('Bạn có chắc muốn xóa mục này?')" title="{{ __('Delete') }}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $categories->links() }}
                    @else
                        <p class="text-center text-danger">Đang cập nhật dữ liệu</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection