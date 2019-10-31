@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
	@can('users_edit')
        <div class="content mt-3">
            @include('includes.alerts')
            <br />
            <div class="animated fadeIn">
                <div class="col-md-12">
                    <div class="row">
                        <div class="card col-md-12">
                            <div class="card-body card-block">
                                <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col-md-6">
                                    	<div class="input-group">
                                    		<div class="input-group-addon"><i class="fa fa-user"></i></div>
	                                        <input type="text" class="form-control" name="name" placeholder="@lang('message.Name')">
                                    	</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                    	<div class="input-group">
                                    		<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                    		<input type="text" class="form-control" name="email" placeholder="@lang('message.E-Mail')">
                                    	</div>
                                    </div>
                                    <div class="form-group col-md-4">
                                    	<div class="input-group">
                                    		<div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                    		<input type="password" class="form-control" name="password" placeholder="@lang('message.Password')">
                                    	</div>
                                    </div>
                                    <div class="form-group col-md-4">
                                    	<div class="input-group">
                                    		<div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                    		<input type="password" class="form-control" name="password_confirmation" placeholder="@lang('message.Confirm_Password')">
                                    	</div>
                                    </div>
                                    <div class="form-group col-md-4">
                                    	<div class="input-group">
                                    		<div class="input-group-addon"><i class="fa fa-users"></i></div>
                                            <select class="form-control" name="role">
                                                <option value="">@lang('message.Select_Profile')...</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">@lang('message.'.$role->label)</option>
                                                @endforeach
                                            </select>
                                    	</div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="box-footer">
                                        <div class="col-md-6 text-left">
                                                <a href="{{ route('user.index') }}"class="btn btn-danger btn-save"><i class="fas fa-arrow-left"></i> @lang('message.Back')</a>
                                            </div>
                                        <div class="col-md-6 text-right">
                                            <button type="submit" class="btn btn-success btn-save"><i class="fa fa-save"></i> @lang('message.Save')</button>
                                        </div>
                                    </div>
                                    <!-- /.box-footer -->
                                </form>
                            </div><!-- /.card-body -->
                        </div><!-- /. card -->
                    </div><!-- /.row -->
                </div>
            </div><!-- .animated -->
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

        @push('form_js')
        	<script src="{{ asset('libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
            <script src="{{ asset('libs/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js') }}"></script>
        @endpush
    @else
        <script>
            window.location.href = "{{ route('home') }}";
        </script>
    @endcan
@stop
