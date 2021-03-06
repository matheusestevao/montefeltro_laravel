@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
    @can('role_add')
            <div class="content mt-3">
                @include('includes.alerts')
                <div class="animated fadeIn">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="card col-md-12">
                                <div class="card-body card-block">
                                    <form action="{{ route('role.store') }}" method="post" class="">
                                        @csrf
                                        <div class="form-group col-md-6">
                                            <label>@lang('message.Name')</label>
                                            <input type="text" class="form-control" name="label" value="{{ old('label') }}" placeholder="@lang('message.Name')">
                                        </div>
                                        
                                        <div class="form-group col-md-6">
                                            <label>@lang('message.Master_Profile')</label>
                                            <select class="form-control" name="master_role">
                                                <option value="">@lang('message.Select')...</option>
                                                @foreach($rolesMaster as $roleMaster)
                                                    <option value="{{ $roleMaster->id }}">{{ $roleMaster->label }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="box-footer">
                                            <div class="col-md-6 text-left">
                                                <a href="{{ route('role.index') }}"class="btn btn-danger btn-save"><i class="fas fa-arrow-left"></i> @lang('message.Back')</a>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button type="submit" class="btn btn-success btn-save"><i class="fa fa-save"></i> @lang('message.Save')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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



