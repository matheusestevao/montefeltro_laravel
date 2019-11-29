
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>@lang('message.'.$pageCurrent) {{ isset($nameCurrent) ? $nameCurrent : '' }}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        @foreach($listBreadcrumb as $breadcrumb)
                            <li class="{{ $breadcrumb['active'] }}">
                                <a href="{{ $breadcrumb['url'] }}">@lang('message.'.$breadcrumb['title'])</a>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
