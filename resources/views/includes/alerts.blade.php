@if($errors->any())
    <div class="col-sm-12">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>
                        @lang('message.'.$error)
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if(session('success'))
    <div class="col-sm-12">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            @lang('message.'.session('success'))
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="col-sm-12">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @lang('message.'.session('error'))
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
