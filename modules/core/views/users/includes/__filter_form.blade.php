<div class="ibox">
    <div class="ibox-content">
        <form action="{{ route('admin.core.user.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="keyword">{{ __('Keyword') }}</label>
                        <input type="text" class="form-control" name="keyword" id="keyword" value="{{ isset($params['keyword']) ? $params['keyword'] : '' }}" placeholder="{{ __('Please input text') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="is_active">{{ __('Status') }}</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="">{{ __('Please select item') }}</option>
                            <option value="{{ \App\Constants\AppConstants::UNCHECKED }}" {{ isset($params['is_active']) && $params['is_active'] == \App\Constants\AppConstants::UNCHECKED ? 'selected' : '' }}>{{ __('Deactivate') }}</option>
                            <option value="{{ \App\Constants\AppConstants::CHECKED }}" {{ isset($params['is_active']) && $params['is_active'] == \App\Constants\AppConstants::CHECKED ? 'selected' : '' }}>{{ __('Active') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary btn-sm" title="{{ __('Search') }}">
                        <i class="fa fa-search"></i> {{ __('Filter') }}
                    </button>
                    <a href="{{ route('admin.core.user.index') }}" class="btn btn-white btn-sm" title="{{ __('Reset') }}">
                        <i class="fa fa-sync"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>