<div class="ibox">
    <div class="ibox-content">
        <form action="{{ route('admin.core.role.index') }}" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="keyword">{{ __('Keyword') }}</label>
                        <input type="text" class="form-control" name="keyword" id="keyword" value="{{ isset($params['keyword']) ? $params['keyword'] : '' }}" placeholder="{{ __('Please input text') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary btn-sm" title="{{ __('Search') }}">
                        <i class="fa fa-search"></i> {{ __('Filter') }}
                    </button>
                    <a href="{{ route('admin.core.role.index') }}" class="btn btn-white btn-sm" title="{{ __('Reset') }}">
                        <i class="fa fa-sync"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>