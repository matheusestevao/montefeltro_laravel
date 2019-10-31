@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
	@can('role_list')
	        <div class="content mt-3">
	            <div class="animated fadeIn">
	                <div class="row">
	                	@include('includes.alerts')
	                    <div class="col-md-12">
	                    	@can('role_add')
	                    		<div>
	                    			<a href="{{ route('role.add') }}" class="btn btn-success">@lang('message.Add_Profile')</a>
	                			</div>
	                			<br />
	                		@endcan
	                        <div class="card">
	                            <div class="card-body">
	                                <table id="table-roles" class="table table-striped table-bordered">
	                                    <thead>
	                                        <tr>
	                                            <th>@lang('message.Id')</th>
	                                            <th>@lang('message.Name')</th>
	                                            <th>@lang('message.Master_Profile')</th>
	                                            <th>@lang('message.Action')</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                    	@forelse($roles as $role)
						                    	<tr>
					                    			<td>{{ $role->id }}</td>
					                    			<td> @lang('message.'.$role->label) </td>
					                    			<td>{{ $role->masterRole['label'] }}</td>
					                    			<td>
						                    			@can('role_edit')
					                    					<a href="{{ route('role.edit', $role->id) }}" class="btn btn-primary" ><i class="fas fa-pencil-alt"></i></a>
						                    			@endcan
						                    			@can('permission_edit')
							                    			<a href="{{ route('permission.edit', $role->id) }}" class="btn btn-warning edir-permission"><i class="fas fa-user-lock"></i></a>
							                    		@endcan
						                    			@if ($role->id > 1)
							                    			@can('role_delete')
								                    			<a href="javascript:;" data-route="{{ route('role.delete', $role->id) }}" data-role="{{ $role->id }}" class="btn btn-danger delete-role"><i class="far fa-trash-alt"></i></a>
								                    		@endcan

								                    	@endif
						                    		</td>
					                    		</tr>
						                    @empty
				                    			<tr>
						                    		<td colspan="4">@lang('message.No_Records')</td>
						                    	</tr>
						                    @endforelse
	                                    </tbody>
	                                </table>
	                            </div>
	                        </div>
	                    </div>


	                </div>
	            </div><!-- .animated -->

	        </div> <!-- .content -->
	    </div><!-- /#right-panel -->

	    <!-- Right Panel -->
	    <script>
			$(document).ready(function() {

				$('.delete-role').click(function () {

					$.ajaxSetup({
						headers: {
					    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  	}
					});

					let route = $(this).attr('data-route');
					let role  = $(this).attr('data-role');
					let el 	  = $(this);

					swal({

						title: "@lang('message.Confirm_Exclusion')?",
						text: "@lang('message.Do_you_really_want_to_delete_this_Profile?_This_action_can_not_be_reversed.')",
						icon: "warning",
						dangerMode: [true],
						buttons: ["@lang('message.No')", true],

					})
					.then((willDelete) => {
						if (willDelete) {

							$.ajax({
								method: 'post',
								type: 'json',
								url: route,
								data: {
									role: role,
								},
								success: function (role) {

									swal("@lang('message.Deleted_Profile_With_Success.')", {
							      		icon: "success",
							    	});

							    	el.parent().parent().remove();

								},
								error: function (role) {

									swal("@lang('message.Error_Deleting_Profile.')", {
							      		icon: "warning",
							    	});

								}

							});

					  	}

					});

				});

			});
		</script>

        @push('datatable_css')
	    	<link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	    @endpush

	    @push('datatable_js')
	    	<script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		    <script>
		    	$('#table-roles').DataTable({
		    		language: {
	                    url : "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json",
	                },
	                pagingType: "full_numbers",
			        lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
			    });
		    </script>
		@endpush

    @else
		<script>
			window.location.href = "{{ route('home') }}";
		</script>
	@endcan
@stop
