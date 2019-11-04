@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
    @can('merchandises_list')
            <div class="content mt-3">
	            <div class="animated fadeIn">
	                <div class="row">
	                	@include('includes.alerts')
	                    <div class="col-md-12">
		                    @can('merchandises_add')
		                    	<div>
			                    	<a href="{{ route('merchandise.add') }}" class="btn btn-success">@lang('message.Input_Merchandise')</a>
			                    	<br /><br />
		                    	</div>
		                    @endcan
		                    <div class="card">
	                            <div class="card-body">
	                                <table id="table-merchandises" class="table table-striped table-bordered">
				                    	<thead>
				                    		<th>@lang('message.Id')</th>
				                    		<th>@lang('message.Client')</th>
				                    		<th>@lang('message.Service Order')</th>
				                    		<th>@lang('message.Amount')</th>
				                    		<th>@lang('message.Category')</th>
				                    		<th>@lang('message.Input')</th>
				                    		<th>@lang('message.Output')</th>
				                    		<th>@lang('message.Withdrawn By')</th>
				                    		<th>@lang('message.Action')</th>
				                    	</thead>
				                    	<tbody>
					                    	@forelse($merchandises as $merchandise)
						                    	<tr>
					                    			<td>{{ $merchandise->id }}</td>
					                    			<td>{{ $merchandise->client($merchandise->client_id) }}</td>
					                    			<td>{{ $merchandise->service_order }}</td>
					                    			<td>{{ $merchandise->amount }}</td>
					                    			<td>{{ $merchandise->category($merchandise->category_id) }}</td>
					                    			<td>{{ date('d/m/Y', strtotime($merchandise->input)) }}</td>
					                    			<td>{{ 
					                    				$merchandise->output != '' ? date('d/m/Y', strtotime($merchandise->output)) : ''
					                    			}}</td>
					                    			<td>{{ $merchandise->withdrawn($merchandise->withdrawn_by) }}</td>
					                    			<td>
						                    			@can('merchandises_edit')
							                    			<a href="{{ route('merchandise.edit', $merchandise->id) }}" class="btn btn-primary" ><i class="fas fa-pencil-alt"></i></a>
							                    		@endcan
						                    		</td>
					                    		</tr>
						                    @empty
						                    	<tr>
						                    		<td colspan="8">@lang('message.No_Records')</td>
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
				$('.delete-merchandise').click(function () {
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
						text: "@lang('message.Really Want to delete this Merchandise? This action cannot be reversed.')",
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
									swal("@lang('message.Merchandise deleted successfully.')", {
							      		icon: "success",
							    	});

							    	el.parent().parent().remove();
								},
								error: function (module) {
									swal("@lang('message.Error deleting Merchandise.')", {
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
		    	$('#table-merchandises').DataTable({
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
