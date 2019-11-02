@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
    @can('clients_list')
            <div class="content mt-3">
	            <div class="animated fadeIn">
	                <div class="row">
	                	@include('includes.alerts')
	                    <div class="col-md-12">
		                    @can('clients_add')
		                    	<div>
			                    	<a href="{{ route('client.add') }}" class="btn btn-success">@lang('message.Add_Client')</a>
			                    	<br /><br />
		                    	</div>
		                    @endcan
		                    <div class="card">
	                            <div class="card-body">
	                                <table id="table-clients" class="table table-striped table-bordered">
				                    	<thead>
				                    		<th>@lang('message.Id')</th>
				                    		<th>@lang('message.Name')</th>
				                    		<th>@lang('message.External_Seller')</th>
				                    		<th>@lang('message.Internal_Seller')</th>
				                    		<th>@lang('message.Action')</th>
				                    	</thead>
				                    	<tbody>
					                    	@forelse($clients as $client)
						                    	<tr>
					                    			<td>{{ $client->id }}</td>
					                    			<td>{{ $client->name }}</td>
					                    			<td>{{ $client->sellerName($client->external_id) }}</td>
					                    			<td>{{ $client->sellerName($client->internal_id) }}</td>
					                    			<td>
						                    			@can('clients_edit')
							                    			<a href="{{ route('client.edit', $client->id) }}" class="btn btn-primary" ><i class="fas fa-pencil-alt"></i></a>
							                    		@endcan
							                    		@can('clients_delete')
                                                            <a href="javascript:;" data-route="{{ route('client.delete', $client->id) }}" data-user="{{ $client->id }}" class="btn btn-danger delete-client"><i class="far fa-trash-alt"></i></a>
                                                        @endcan
						                    		</td>
					                    		</tr>
						                    @empty
						                    	<tr>
						                    		<td colspan="5">@lang('message.No_Records')</td>
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
				$('.delete-client').click(function () {
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
						text: "@lang('message.Really Want to delete this Client? This action cannot be reversed.')",
						icon: "warning",
						dangerMode: [true],
						buttons: ["@lang('message.No')", "@lang('message.Yes')"],

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
									swal("@lang('message.Client deleted successfully.')", {
							      		icon: "success",
							    	});

							    	el.parent().parent().remove();
								},
								error: function (module) {
									swal("@lang('message.Error deleting client.')", {
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
			<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
	    @endpush

	    @push('datatable_js')
            <script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
			<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
			<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
			<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
		    <script>
		    	$('#table-clients').DataTable({
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
