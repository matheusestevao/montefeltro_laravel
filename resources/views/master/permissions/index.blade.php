@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
	@can('permission_list')
			<div class="content mt-3">
	            <div class="animated fadeIn">
	                <div class="row">
	                	@include('includes.alerts')
	                    <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <table id="table-permissions" class="table table-striped table-bordered">
				                    	<thead>
				                    		<th>@lang('message.Id')</th>
				                    		<th>@lang('message.Profile')</th>
				                    		<th>@lang('message.Master_Profile')</th>
				                    		<th>@lang('message.Action')</th>
				                    	</thead>
				                    	<tbody>
					                    	@forelse($roles as $role)
						                    	<tr>
					                    			<td>{{ $role->id }}</td>
					                    			<td>{{ $role->label }}</td>
					                    			<td>
					                    				{{ $role->master_role == '' ? '--' : $role->masterRole['label'] }}
					                    			</td>
					                    			<td>
					                    				@if ($role->id != 1)
							                    			@can('permission_edit')
								                    			<a href="{{ route('permission.edit', $role->id) }}" class="btn btn-primary" ><i class="fas fa-pencil-alt"></i></a>
								                    		@endcan
							                    			@can('permission_delete')
								                    			<a href="javascript:;" data-route="{{ route('permission.delete', $role->id) }}" data-role="{{ $role->id }}" class="btn btn-danger delete-permission"><i class="far fa-trash-alt"></i></a>
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
		                		</div><!-- /.card-body -->
		                	</div><!-- /.card -->
		            	</div>
		        	</div><!-- /.row -->
		    	</div><!-- /.animated -->
		    </div><!-- /.content -->
		</div><!-- /#right-panel -->

	    <!-- Right Panel -->

	    <script>
			$(document).ready(function() {

				$('.delete-permission').click(function () {

					$.ajaxSetup({
						headers: {
					    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  	}
					});

					let route = $(this).attr('data-route');
					let role  = $(this).attr('data-role');
					let el    = $(this);

					swal({
						title: "@lang('message.Confirm_Exclusion')?",
						text: "@lang('message.Do_you_really_want_to_leave_the_Profile_without_Permissions?This_action_will_only_be_reversed_manually,_or_by_integrating_a_Master_Profile_into_the_Profile_that_is_clearing_the_information.')",
						icon: "warning",
						dangerMode: [true],
						buttons: ["@lang('message.No')", true],

					})
					.then((willDelete) => {
						if (willDelete) {

							$.ajax({
								method: 'POST',
								type: 'json',
								url: route,
								data : {
									role: role,
								},
								success: function (module) {

									swal({
										title: "Success",
										text:  "@lang('message.Permissions_removed_successfully._This_action_will_only_be_reversed_manually,_or_by_integrating_a_Master_Profile_into_the_Profile_that_was_the_Clean_Permissions.')",
										icon:  "success",
										dangerMode: [true],
									})
									.then((willDelete) => {
										window.location.href = "{{ route('permission.index') }}";
									});

								},
								error: function (module) {

									swal("@lang('message.Error_clearing_permissions.')", {
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
		    	$('#table-permissions').DataTable({
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

@endsection
