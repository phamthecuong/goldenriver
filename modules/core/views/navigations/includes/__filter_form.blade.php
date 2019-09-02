<div class="ibox">
    <div class="ibox-content">
        <form action="{{ route('admin.core.nav.index') }}" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="keyword">{{ __('Keyword') }}</label>
                        <input type="text" class="form-control" name="keyword" id="keyword" value="{{ isset($params['keyword']) ? $params['keyword'] : '' }}" placeholder="{{ __('Please input text') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="is_active">{{ __('Status') }}</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="">{{ __('Please select item') }}</option>
                            <option value="{{ \App\Constants\AppConstants::UNCHECKED }}" {{ isset($params['is_active']) && $params['is_active'] == \App\Constants\AppConstants::UNCHECKED ? 'selected' : '' }}>{{ __('Deactivate') }}</option>
                            <option value="{{ \App\Constants\AppConstants::CHECKED }}" {{ isset($params['is_active']) && $params['is_active'] == \App\Constants\AppConstants::CHECKED ? 'selected' : '' }}>{{ __('Active') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="group">{{ __('Group') }}</label>
                        <select name="group" id="group" class="form-control">
                            <option value="">{{ __('Please select item') }}</option>
                            <option value="{{ \Modules\core\models\Navigation::GROUP_HEADER }}" {{ isset($params['group']) && $params['group'] == \Modules\core\models\Navigation::GROUP_HEADER ? 'selected' : '' }}>{{ __('Header') }}</option>
                            <option value="{{ \Modules\core\models\Navigation::GROUP_FOOTER }}" {{ isset($params['group']) && $params['group'] == \Modules\core\models\Navigation::GROUP_FOOTER ? 'selected' : '' }}>{{ __('Footer') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="parent_id">{{ __('Parent') }}</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="">{{ __('Please select item') }}</option>
                            @if(!empty($navigations = \Modules\core\models\Navigation::getInstance()->buildNavTree()))
                                @foreach($navigations as $navigation)
                                    <option value="{{ $navigation['navigation_id'] }}" {{ isset($params['parent_id']) && $params['parent_id'] == $navigation['navigation_id'] ? 'selected' : '' }}>{{ $navigation['title'] }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary btn-sm" title="{{ __('Search') }}">
                        <i class="fa fa-search"></i> {{ __('Filter') }}
                    </button>
                    <a href="{{ route('admin.core.nav.index') }}" class="btn btn-white btn-sm" title="{{ __('Reset') }}">
                        <i class="fa fa-sync"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>