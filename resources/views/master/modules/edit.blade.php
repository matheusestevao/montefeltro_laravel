@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
    @can('module_add')
            <div class="content mt-3">
                @include('includes.alerts')
                <br />
                <div class="animated fadeIn">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="card col-md-12">
                                <div class="card-body card-block">
                                    <form action="{{ route('module.update', $module->id) }}" method="post" class="">
                                        @csrf
                                        <div class="form-group col-md-4">
                                            <label>@lang('message.Name')</label>
                                            <input type="text" class="form-control" name="label" value="{{ $module->label }}" placeholder="@lang('message.Name')">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>@lang('message.Group')</label>
                                            <input type="text" class="form-control" name="group" placeholder="@lang('message.Group')" value="{{ $module->group }}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>@lang('message.Menu')?</label>
                                            <select class="form-control" name="menu_left">
                                                <option value="">@lang('message.Select')...</option>
                                                <option value="0" {{ $module->menu_left == 0 ? 'selected' : '' }}>@lang('message.No')</option>
                                                <option value="1" {{ $module->menu_left == 1 ? 'selected' : '' }}>@lang('message.Yes')</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>@lang('message.Master')?</label>
                                            <select class="form-control" name="menu_master">
                                                <option value="">@lang('message.Select')...</option>
                                                <option value="0" {{ $module->menu_master == 0 ? 'selected' : '' }}>@lang('message.No')</option>
                                                <option value="1" {{ $module->menu_master == 1 ? 'selected' : '' }}>@lang('message.Yes')</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>@lang('message.Page_index')</label>
                                            <input type="text" class="form-control" name="page_index" placeholder="@lang('message.Page_index')" value="{{ $module->page_index }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>@lang('message.Menu_icon')</label>
                                            <input type="text" class="form-control" name="menu_icon" placeholder="@lang('message.Menu_icon')" value="{{ $module->menu_icon }}">
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="box-footer">
                                            <div class="col-md-6 text-left">
                                                <a href="{{ route('module.index') }}"class="btn btn-danger btn-save"><i class="fas fa-arrow-left"></i> @lang('message.Back')</a>
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
        @endpush
    @else
        <script>
            window.location.href = "{{ route('home') }}";
        </script>
    @endcan
@endsection
