@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
	@can('myprofile_edit', $user)
        <div class="content mt-3">
            @include('includes.alerts')
            <br />
            <div class="animated fadeIn">
                <div class="col-md-12">
                    <div class="row">
                        <div class="card col-md-12">
                            <div class="card-body card-block">
                                <form action="{{ route('profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col-md-6">
                                    	<div class="input-group">
                                    		<div class="input-group-addon"><i class="fa fa-user"></i></div>
	                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="@lang('message.Name')">
                                    	</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                    	<div class="input-group">
                                    		<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                    		<input type="text" class="form-control" name="email" value="{{ $user->email }}" placeholder="@lang('message.E-Mail')">
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
                                    		<input type="password" class="form-control" name="confirm_password" placeholder="@lang('message.Confirm_Password')">
                                    	</div>
                                    </div>
                                    <div class="form-group col-md-4">
                                    	<div class="input-group">
                                    		<div class="input-group-addon"><i class="fa fa-users"></i></div>
	                                    	<input type="text" id="disabled-input" placeholder="Perfil" disabled class="form-control" value="{{ $user->ReturnNameRole($user->id) }}">
                                    	</div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group col-md-6">
                                    	<div class="input-group">
                                    		<div class="input-group-addon"><i class="fas fa-image"></i></div>
	                                    	<input type="file" id="input-image-perfil" name="image_perfil" accept="image/*" placeholder="@lang('message.Current_Issue')" class="form-control" value="{{ $user->ReturnNameRole($user->id) }}">
                                    	</div>
                                    </div>
                                    <div class="form-group col-md-6 text-center">
                                    	@if ($user->image_profile != '')
                                    		<span>@lang('message.Current_Issue')</span><br />
                                    		<img src="{{ url('storage/MyProfile/'.$user->image_profile) }}">
                                    	@else
                                    		<span>@lang('message.No_Image_saved_for_this_User')</span>
                                    	@endif
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="box-footer">
                                        <div class="col-md-6 text-left">
                                            <a href="{{ route('home') }}"class="btn btn-primary btn-save"><i class="fas fa-home"></i> @lang('message.Dashboard')</a>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button type="submit" class="btn btn-success btn-save"><i class="fa fa-save"></i> @lang('message.Update')</button>
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
            <script>
            	$(document).ready(function() {

            		$("#input-image-perfil").change(function() {

            			let fup 	 = $(this);
					    let fileName = fup.val();
					    let ext      = fileName.substring(fileName.lastIndexOf('.') + 1);

					    if (ext=="jpeg" || ext=="png" || ext=="jpg" || ext=="gif" || ext=="bmp" || ext=="svg") {

					        return true;
					   
					    } else {

					        swal({
								title: "Erro",
								text: "{{ trans('message.The selected file is not an image.') }}",
								icon: "warning",
							});

							$(this).val("");
					    
					    }

            		});

            	});
            </script>
        @endpush
    @else
        <script>
            window.location.href = "{{ route('home') }}";
        </script>
    @endcan
@stop