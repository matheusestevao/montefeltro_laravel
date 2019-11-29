@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
    @can('permission_edit')
        <style>
            .switch.switch-text .switch-label {
                background: red;
            }
            .role_son {
                max-width: 91px;
            }
        </style>
            <div class="content mt-3">
                @include('includes.alerts')
                <div class="animated fadeIn">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="card col-md-12">
                                <div class="card-body card-block">
                                    <form action="{{ route('permission.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                                        <div class="form-group col-md-12">
                                            <table class="table">
                                                <thead>
                                                    <thead>
                                                        <th></th>
                                                        <th>@lang('message.Menu')</th>
                                                        <th>@lang('message.List')</th>
                                                        <th>@lang('message.Add')</th>
                                                        <th>@lang('message.Edit')</th>
                                                        <th>@lang('message.View')</th>
                                                        <th>@lang('message.Delete')</th>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($modules as $module)
                                                            <tr>
                                                                <td>
                                                                    {{ $module->label }}<br />
                                                                    <small>{{ $module->name }}</small>
                                                                </td>
                                                                @foreach(modulePermissions($module->id) as $modulePermission)
                                                                    <td>
                                                                        <label class="switch switch-text switch-success switch-pill" id="label-permission" data-check="{{ permissionModuleRole($role->id, $modulePermission->id) ? 'yes' : 'no' }}">
                                                                            <input type="checkbox" class="switch-input" name="permission_{{$modulePermission->id}}" {{ permissionModuleRole($role->id, $modulePermission->id) ? 'checked="true"' : '' }} >
                                                                            <span data-on="@lang('message.Yes')" data-off="@lang('message.No')" class="switch-label"></span>
                                                                            <span class="switch-handle"></span>
                                                                        </label>
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @empty
                                                        @endforelse
                                                        </tr>
                                                    </tbody>
                                                </thead>
                                            </table>
                                        </div>

                                        <div class="box-footer">
                                            <div class="col-md-6 text-left">
                                                <a href="{{ route('permission.index') }}"class="btn btn-danger btn-save"><i class="fas fa-arrow-left"></i> @lang('message.Back')</a>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button type="submit" class="btn btn-success btn-save"><i class="fa fa-save"></i> @lang('message.Save')</button>
                                            </div>
                                        </div>
                                        <!-- /.box-footer -->
                                    </form>
                                </div><!-- /.card-body -->
                            </div><!-- /.card -->
                        </div><!-- /.row -->
                    </div>
                </div><!-- /.animated -->
            </div><!-- /.content -->
        </div><!-- /#right-panel -->

        <!-- Right Panel -->

        <script>
            $("#label-permission").bootstrapSwitch({
                onColor: 'danger',
                offColor: 'success'
            });
        </script>
    @else
        <script>
            window.location.href = "{{ route('home') }}";
        </script>
    @endcan
@endsection
