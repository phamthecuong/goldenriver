<div class="ibox">
    <div class="ibox-title">
        <h5>{{ __('Filter') }}</h5>

        <div class="ibox-tools">
            <a class="collapse-link" href="">
                <i class="fa fa-chevron-down"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content hide">
        <form action="{{ route('admin.cms.category.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ isset($params['title']) ? $params['title'] : '' }}" placeholder="{{ __('Please input text') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="parent">{{ __('Parent') }}</label>
                        <select name="parent_id" id="parent" class="form-control">
                            <option value="">{{ __('Please select item') }}</option>
                            @if(!empty($parentsCategory = \Modules\cms\models\Category::getInstant()->buildCategoryTree()))
                            @foreach($parentsCategory as $parentCategory)
                            <option value="{{ $parentCategory['category_id'] }}" {{ isset($params['parent_id']) && $params['parent_id'] == $parentCategory['category_id'] ? 'selected' : '' }} >{{ $parentCategory['title'] }}</option>
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
                            <option value="{{ \App\Constants\AppConstants::UNCHECKED }}" {{ isset($params['status']) && $params['status'] == \App\Constants\AppConstants::UNCHECKED ? 'selected' : '' }}>{{ __('Deactivate') }}</option>
                            <option value="{{ \App\Constants\AppConstants::CHECKED }}" {{ isset($params['status']) && $params['status'] == \App\Constants\AppConstants::CHECKED ? 'selected' : '' }}>{{ __('Active') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary btn-sm" title="{{ __('Search') }}">
                        <i class="fa fa-search"></i> {{ __('Filter') }}
                    </button>
                    <a href="{{ route('admin.cms.category.index') }}" class="btn btn-white btn-sm" title="{{ __('Reset') }}">
                        <i class="fa fa-sync"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>