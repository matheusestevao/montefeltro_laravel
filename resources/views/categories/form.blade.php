@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
    @canany(['categories_add', 'categories_edit'])
        <div class="content mt-3">
            @include('includes.alerts')
            <br />
            <div class="animated fadeIn">
                <div class="col-md-12">
                    <div class="row">
                        <div class="card col-md-12">
                            <div class="card-body card-block">
                                @if(!isset($category))
                                    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                                @else
                                    <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                                @endif
                                    @csrf
                                    <div class="form-group col-md-4">
                                        <label>@lang('message.Name')</label>
                                    	<div class="input-group">
	                                        <input type="text" class="form-control" name="name" placeholder="@lang('message.Name')" value="{{ $category->name ?? old('name')}}">
                                    	</div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="box-footer">
                                        <div class="col-md-6 text-left">
                                                <a href="{{ route('category.index') }}"class="btn btn-danger btn-save"><i class="fas fa-arrow-left"></i> @lang('message.Back')</a>
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
    @endcanany
@endsection
