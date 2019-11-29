@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
	@can('module_list')
			<div class="content mt-3">
	            <div class="animated fadeIn">
	                <div class="row">
	                	@include('includes.alerts')
	                    <div class="col-md-12">
		                    @can('module_add')
		                    	<div>
			                    	<a href="{{ route('module.add') }}" class="btn btn-success">@lang('message.Add_Module')</a>
			                    	<br /><br />
		                    	</div>
		                    @endcan
		                    <div class="card">
	                            <div class="card-body">
	                                <table id="table-modules" class="table table-striped table-bordered">
				                    	<thead>
				                    		<th>@lang('message.Id')</th>
				                    		<th>@lang('message.Name')</th>
				                    		<th>@lang('message.Action')</th>
				                    	</thead>
				                    	<tbody>
					                    	@forelse($modules as $module)
						                    	<tr>
					                    			<td>{{ $module->id }}</td>
					                    			<td>{{ $module->label }}</td>
					                    			<td>
						                    			@can('module_edit')
							                    			<a href="{{ route('module.edit', $module->id) }}" class="btn btn-primary" ><i class="fas fa-pencil-alt"></i></a>
							                    		@endcan
							                    		@if ($module->id > 4)
								                    		@can('module_delete')
								                    			<a href="javascript:;" data-route="{{ route('module.delete', $module->id) }}" data-module="{{ $module->id }}" class="btn btn-danger delete-module"><i class="far fa-trash-alt"></i></a>
								                    		@endcan
								                    	@endif
						                    		</td>

					                    		</tr>
						                    @empty
						                    	<tr>
						                    		<td colspan="3">@lang('message.No_Records')</td>
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

	    <script>
			$(document).ready(function() {
				$('.delete-module').click(function () {
					$.ajaxSetup({
						headers: {
					    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  	}
					});

					let route  = $(this).attr('data-route');
					let module = $(this).attr('data-module');
					let el     = $(this);

					swal({
						title: "@lang('message.Confirm_Exclusion')?",
						text: "@lang('message.Do_you_really_want_to_delete_this_module?This_action_can_not_be_reversed.')",
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
									module: module,
								},
								success: function (module) {
									swal("@lang('message.Module_deleted_successfully.')", {
							      		icon: "success",
							    	});

							    	el.parent().parent().remove();

									setTimeout(function(){
										window.location.reload();
									}, 3000);
								},
								error: function (module) {
									swal("@lang('message.Error_deleting_module.')", {
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
		    	$('#table-modules').DataTable({
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
