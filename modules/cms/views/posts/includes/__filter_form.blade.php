<div class="ibox">
    <div class="ibox-title">
        <h5>{{ __('Filter') }}</h5>

        <div class="ibox-tools">
            <a class="collapse-link" href="">
                <i class="fa fa-chevron-down"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content {{ !empty($params) ? : 'hide' }}">
        <form action="{{ route('admin.cms.post.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ isset($params['title']) ? $params['title'] : '' }}" placeholder="{{ __('Please input text') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category">{{ __('Category') }}</label>
                        <select name="category_id" id="category" class="form-control">
                            <option value="">{{ __('Please select category') }}</option>
                            @if (!empty($categories = \Modules\cms\models\Category::getInstant()->buildCategoryTree()))
                                @foreach($categories as $category)
                                    <option value="{{ $category['category_id'] }}" {{ isset($params['category_id']) && $params['category_id'] == $category['category_id'] ? 'selected' : '' }}>{{ $category['title'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">{{ __('Status') }}</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">{{ __('Please select item') }}</option>
                            <option value="0" {{ isset($params['status']) && $params['status'] == 0 ? 'selected' : '' }}>{{ __('Deactivate') }}</option>
                            <option value="1" {{ isset($params['status']) && $params['status'] == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary btn-sm" title="{{ __('Search') }}">
                        <i class="fa fa-search"></i> {{ __('Filter') }}
                    </button>
                    <a href="{{ route('admin.cms.post.index') }}" class="btn btn-white btn-sm" title="{{ __('Reset') }}">
                        <i class="fa fa-sync"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>