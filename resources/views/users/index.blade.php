@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
	@can('users_list')
			<div class="content mt-3">
	            <div class="animated fadeIn">
	                <div class="row">
	                	@include('includes.alerts')
	                    <div class="col-md-12">
		                    @can('users_add')
		                    	<div>
			                    	<a href="{{ route('user.add') }}" class="btn btn-success">@lang('message.Add_User')</a>
			                    	<br /><br />
		                    	</div>
		                    @endcan
		                    <div class="card">
	                            <div class="card-body">
	                                <table id="table-users" class="table table-striped table-bordered">
				                    	<thead>
				                    		<th>@lang('message.Id')</th>
				                    		<th>@lang('message.Name')</th>
				                    		<th>@lang('message.Profile')</th>
				                    		<th>@lang('message.Action')</th>
				                    	</thead>
				                    	<tbody>
					                    	@forelse($users as $user)
						                    	<tr>
					                    			<td>{{ $user->id }}</td>
					                    			<td>{{ $user->name }}</td>
					                    			<td>{{ $user->ReturnNameRole($user->id) }}</td>
					                    			<td>
						                    			@can('users_edit')
							                    			<a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary" ><i class="fas fa-pencil-alt"></i></a>
							                    		@endcan
							                    		@if($user->id > 2)
							                    			@can('users_delete')
								                    			<a href="javascript:;" data-route="{{ route('user.delete', $user->id) }}" data-user="{{ $user->id }}" class="btn btn-danger delete-user"><i class="far fa-trash-alt"></i></a>
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

				$('.delete-user').click(function () {

					$.ajaxSetup({
						headers: {
					    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  	}
					});

					let route  = $(this).attr('data-route');
					let module = $(this).attr('data-module');
					let el     = $(this);

					swal({
						title: "Confirm Delete?",
						text: "Realmente Deseja deletar este usuário? Essa ação não poderá ser revertida.",
						icon: "warning",
						dangerMode: [true],
						buttons: ["Não", true],

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

									swal("Usuário deletado com sucesso.", {
							      		icon: "success",
							    	});

							    	el.parent().parent().remove();

								},
								error: function (module) {

									swal("Erro ao deletar o usuário.", {
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
		    	$('#table-users').DataTable({
		    		language: {
	                    url : "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json",
	                },
	                pagingType: "full_numbers",
			        lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
			        dom: 'Bfrtip',
			        buttons: [
			        	{
			        		extend: 'csv',
			        		text: '<i class="icon-datatable fas fa-file-csv"></i>',
			        		title: "@lang('message.Users_Listing')",
			        		filename: "@lang('message.Users_Listing')",
			        	},
			        	{
			        		extend: 'excel',
			        		text: '<i class="icon-datatable fas fa-file-excel"></i>',
			        		title: "@lang('message.Users_Listing')",
			        		filename: "@lang('message.Users_Listing')",
			        	},
			        	{
			        		extend: 'pdfHtml5',
			        		text: '<i class="icon-datatable fas fa-file-pdf"></i>',
			        		title: "@lang('message.Users_Listing')",
			        		filename: "@lang('message.Users_Listing')",
			        	}
			        ]
			    });
		    </script>
		@endpush

	@else
		<script>
			window.location.href = "{{ route('home') }}";
		</script>
	@endcan
@endsection
