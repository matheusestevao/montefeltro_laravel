@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
    @can('merchandises_edit')
        <div class="content mt-3">
            @include('includes.alerts')
            <br />
            <div class="animated fadeIn">
                <div class="col-md-12">
                    <div class="row">
                        <div class="card col-md-12">
                            <div class="card-body card-block">
                                <form action="{{ route('merchandise.update', $merchandise->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-lg-12 form-group">
                                        <table class="table table-striped table-bordered" id="boxMerchadise">
                                            <thead>
                                                <tr>
                                                    <th>@lang('message.Client')</th>
                                                    <th>@lang('message.Service Order')</th>
                                                    <th>@lang('message.Amount')</th>
                                                    <th>@lang('message.Category')</th>
                                                    <th>@lang('message.Input')</th>
                                                    <th>@lang('message.Output')</th>
                                                    <th>@lang('message.Withdrawn By')</th>
                                                    <th>@lang('message.Note')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="insertMechandise_client" class="form-control" required="required">
                                                            <option value=''>@lang('message.Select')...</option>
                                                            @foreach($clients as $client)
                                                                <option value="{{ $client->id }}"
                                                                    {{ $client->id == $merchandise->client_id ? 'selected' : '' }}>{{ $client->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="insertMechandise_service_order" class="form-control" value="{{$merchandise->service_order}}" required="required">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="insertMechandise_amount" required="required" class="form-control" value="{{$merchandise->amount}}">
                                                    </td>
                                                    <td>
                                                        <select name="insertMechandise_category" class="form-control">
                                                            <option value=''>@lang('message.Select')...</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ $category->id == $merchandise->category_id ? 'selected' : ''}}>{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="date" name="insertMechandise_input" class="form-control" value="{{$merchandise->input}}">
                                                    </td>
                                                    <td>
                                                        <input type="date" name="insertMechandise_output" class="form-control" value="{{$merchandise->output}}">
                                                    </td>
                                                    <td>
                                                        <select name="insertMechandise_withdrawn" class="form-control">
                                                            <option value=''>@lang('message.Select')...</option>
                                                            @foreach($users as $user)
                                                                <option value="{{ $user->id }}"
                                                                    {{
                                                                        $merchandise->withdrawn_by != '' ?? ($merchandise->withdrawn_by == $user->id ?? 'selected')
                                                                    }}>{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <textarea name="insertMechandise_note" id="textarea-input" cols="19" placeholder="@lang('message.Note')..." class="form-control">{{ $merchandise->note }}</textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div><!--DIV componente Merchandise -->
                                    <br /><br />
                                    <div class="box-footer">
                                        <div class="col-md-6 text-left">
                                                <a href="{{ route('merchandise.index') }}"class="btn btn-danger btn-save"><i class="fas fa-arrow-left"></i> @lang('message.Back')</a>
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
        @endpush
    @else
        <script>
            window.location.href = "{{ route('home') }}";
        </script>
    @endcan
@endsection
