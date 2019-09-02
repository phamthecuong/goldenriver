@extends('layouts.admin.main')
@section('title', __('Pages'))

@section('action_title')
    <a class="btn btn-primary" href="{{ route('admin.page.create') }}" title="{{ __('Create Page') }}">
        <i class="fa fa-plus"></i>
        {{ __('Create Page') }}
    </a>
    <a class="btn btn-default" href="{{ route('admin.page.index') }}" title="{{ __('Reset Filter') }}">
        <i class="fas fa-sync"></i>
        {{ __('Reset Filter') }}
    </a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ibox-primary">
                <div class="ibox-title">
                    <h5>{{ __('Pages') }}</h5>
                </div>
                <div class="ibox-content">
                    @if($pages->isNotEmpty())
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{!! \App\Helpers\SortableHelper::sortLink('title', 'admin.page.index', $params, __('Title')) !!}</th>
                                <th>{!! \App\Helpers\SortableHelper::sortLink('slug', 'admin.page.index', $params, __('Slug')) !!}</th>
                                <th>{!! \App\Helpers\SortableHelper::sortLink('is_active', 'admin.page.index', $params, __('Active')) !!}</th>
                                <th>{!! \App\Helpers\SortableHelper::sortLink('created_at', 'admin.page.index', $params, __('Created At')) !!}</th>
                                <th>{!! \App\Helpers\SortableHelper::sortLink('created_by', 'admin.page.index', $params, __('Created By')) !!}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $key => $page)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><a href="{{ route('admin.page.view', $page->page_id) }}">{{ $page->title }}</a></td>
                                    <td>{{ $page->slug }}</td>
                                    <td>
                                        @if($page->is_active)
                                            <a href="{{ route('admin.page.toggle', ['id' => $page->page_id, 'field' => 'is_active']) }}" class="text-success" title="{{ __('Active') }}">
                                                <i class="fa fa-check text-success"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('admin.page.toggle', ['id' => $page->page_id, 'field' => 'is_active']) }}" class="text-danger" title="{{__('Deactivate')}}">
                                                <i class="fa fa-ban"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $page->created_at->diffForHumans() }}</td>
                                    <td>{{ $page->createdBy ? $page->createdBy->name : '' }}</td>
                                    <td width="100" class="text-right footable-visible footable-last-column">
                                        <div class="btn-group">
                                            <a class="btn btn-primary btn-xs" href="{{ route('admin.page.view', $page->page_id) }}" title="{{ __('View') }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a class="btn btn-primary btn-xs" href="{{ route('admin.page.edit', $page->page_id) }}" title="{{ __('Update') }}">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="{{ __('Delete') }}" onclick="return cms.confirm('Bạn có chắc là muốn xóa mục này?') ? $('#page_remove').submit() : false">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form action="{{ route('admin.page.delete', $page->page_id) }}" id="page_remove" method="post">
                                                @csrf
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                        {{ $pages->appends($params)->links() }}
                    @else
                        <p class="text-center text-danger">Đang cập nhật dữ liệu</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection