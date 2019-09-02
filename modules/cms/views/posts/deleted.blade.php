@extends('layouts.admin.main')
@section('title', __('Posts'))
@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.cms.post.index') }}">{{ __('Posts') }}</a>
    </li>
@endsection
@section('action_title')
    <a href="{{ route('admin.cms.post.create') }}" class="btn btn-primary" title="{{ __('Create Post') }}">
        <i class="fa fa-plus"></i>
        {{ __('Create Post') }}
    </a>
    <a href="{{ route('admin.cms.post.deleted') }}" title="{{ __('Reset Filter') }}" class="btn btn-white">
        <i class="fas fa-sync"></i>
        {{ __('Reset Filter') }}
    </a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('cms::posts.includes.__filter_form')

            <div class="ibox">
                <div class="ibox-title">
                    <h5>{{ __('Posts') }}</h5>
                </div>
                <div class="ibox-content">
                    @if($posts->isNotEmpty())
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th class="text-center">{{ __('Avatar') }}</th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('title', 'admin.cms.post.deleted', $params, __('Title')) !!}
                                </th>
                                <th>{!! \App\Helpers\SortableHelper::sortLink('slug', 'admin.cms.post.deleted', $params) !!}</th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('description', 'admin.cms.post.deleted', $params, __('Description')) !!}
                                </th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('category_id', 'admin.cms.post.deleted', $params, __('Category')) !!}
                                </th>
                                <th class="text-center" style="width: 150px;">
                                    {!! \App\Helpers\SortableHelper::sortLink('published_f', 'admin.cms.post.deleted', $params, __('Published')) !!}
                                </th>
                                <th class="text-center" style="width: 150px;">
                                    {!! \App\Helpers\SortableHelper::sortLink('is_feature', 'admin.cms.post.deleted', $params, __('Feature')) !!}
                                </th>
                                <th>
                                    {!! \App\Helpers\SortableHelper::sortLink('created_at', 'admin.cms.post.deleted', $params, __('Created At')) !!}
                                </th>
                                <th class="text-right" style="width: 100px;">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $key => $post)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ $post->thumbnail() }}" alt="{{ $post->title }}">
                                    </td>
                                    <td><a href="{{ route('admin.cms.post.edit', $post->post_id) }}" title="{{ $post->title }}">{{ $post->title }}</a></td>
                                    <td>{{ $post->slug }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($post->description, 50)  }}</td>
                                    <td>
                                        @if($post->category)
                                            <a href="{{ route('admin.cms.category.view', $post->category_id) }}" title="{{ $post->category->title }}">{{ $post->category->title }}</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($post->published_f)
                                            <a href="{{ route('admin.cms.post.state', ['id' => $post->post_id, 'field' => 'published_f']) }}" title="{{ __('Active') }}"><i class=" fa fa-check"></i></a>
                                        @else
                                            <a href="{{ route('admin.cms.post.state', ['id' => $post->post_id, 'field' => 'published_f']) }}" title="{{ __('Deactivate') }}" class="text-muted"><i class=" fa fa-check"></i></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($post->is_feature)
                                            <a href="{{ route('admin.cms.post.state', ['id' => $post->post_id, 'field' => 'is_feature']) }}" title="{{ __('Active') }}"><i class=" fa fa-check"></i></a>
                                        @else
                                            <a href="{{ route('admin.cms.post.state', ['id' => $post->post_id, 'field' => 'is_feature']) }}" title="{{ __('Deactivate') }}" class="text-muted"><i class=" fa fa-check"></i></a>
                                        @endif
                                    </td>
                                    <td>{{ $post->created_at->diffForHumans() }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.cms.post.edit', $post->post_id) }}" title="{{ __('Update') }}"><i class="fa fa-pencil-alt"></i></a>
                                        <a href="#" onclick="return cms.confirm('Bạn có chắc muốn xóa mục này?') ? $('#remove_post').submit() : false" title="{{ __('Delete') }}" class="text-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form action="{{ route('admin.cms.post.delete', $post->post_id) }}" method="post" id="remove_post">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $posts->links() }}
                    @else
                        <p class="text-center text-danger">Đang cập nhật dữ liệu</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection