@section('left_panel')
<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>

                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('image/logo_skinny.png') }}" alt="Logo">
                </a>

                <a class="navbar-brand hidden" href="{{ route('home') }}">
                    <img src="{{ asset('image/face.png') }}" alt="Logo">
                </a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active dashboard">
                        <a href="{{ route('home') }}">
                            <i class="menu-icon fa fa-dashboard"></i>@lang('message.Dashboard')
                        </a>
                    </li>
                    @php
                        $idUser = auth::user()->id;

                        $itensMenu = app(App\Http\Controllers\System\MenuController::class)->systemMenu($idUser);

                        $group = '';
                    @endphp

                    @foreach($itensMenu as $itemMenu)

                        @php
                            $newGroup = $itemMenu->group;
                        @endphp

                            @if ($newGroup == '')

                                @can($itemMenu->name)
                                    <li>
                                        <a href="{{ route($itemMenu->page_index) }}">
                                            <i class="menu-icon {{ $itemMenu->menu_icon }}"></i>@lang('message.'.$itemMenu->label)
                                        </a>
                                    </li>
                                @endcan

                            @elseif ($newGroup != $group)

                                @if($group != '')
                                        </ul>
                                    </li>
                                @endif

                                <li class="menu-item-has-children dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="menu-icon fas fa-list"></i>
                                        @lang('message.'.$itemMenu->group)
                                    </a>
                                    <ul class="sub-menu children dropdown-menu">
                                        @can($itemMenu->name)
                                            <li>
                                                <i class="menu-icon {{ $itemMenu->menu_icon }}"></i><a href="{{ route($itemMenu->page_index) }}">
                                                    @lang('message.'.$itemMenu->label)
                                                </a>
                                            </li>
                                        @endcan
                            @else

                                @can($itemMenu->name)
                                    <li>
                                        <i class="menu-icon {{ $itemMenu->menu_icon }}"></i><a href="{{ route($itemMenu->page_index) }}">
                                            @lang('message.'.$itemMenu->label)
                                        </a>
                                    </li>
                                @endcan

                            @endif

                        @php
                            $group = $itemMenu->group;
                        @endphp

                    @endforeach
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->
    <!-- Left Panel -->
@endsection
