@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
    @canany(['clients_add', 'clients_edit'])
        <div class="content mt-3">
            @include('includes.alerts')
            <br />
            <div class="animated fadeIn">
                <div class="col-md-12">
                    <div class="row">
                        <div class="card col-md-12">
                            <div class="card-body card-block">
                                @if(!isset($client))
                                    <form action="{{ route('client.store') }}" method="post" enctype="multipart/form-data">
                                @else
                                    <form action="{{ route('client.update', $client->id) }}" method="post" enctype="multipart/form-data">
                                @endif
                                    @csrf
                                    <div class="form-group col-md-4">
                                        <label>@lang('message.Name')</label>
                                    	<div class="input-group">
	                                        <input type="text" class="form-control" name="name" placeholder="@lang('message.Name')" value="{{ $client->name ?? old('name')}}">
                                    	</div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>@lang('message.Select_External_Seller')</label>
                                    	<div class="input-group">
                                            <select class="form-control" name="external_seller">
                                                <option value="">@lang('message.Select_External_Seller')...</option>
                                                @foreach($externalSellers as $externalSeller)
                                                    <option value="{{ $externalSeller->id }}"
                                                        {{ isset($client->external_id) ? ($client->external_id == $externalSeller->id ? 'selected' : '') : old('external_seller') == $externalSeller->id ? 'selected' : ''}}
                                                        >{{ $externalSeller->name }}</option>
                                                @endforeach
                                            </select>
                                    	</div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>@lang('message.Select_Internal_Seller')</label>
                                    	<div class="input-group">
                                            <select class="form-control" name="internal_seller">
                                                <option value="">@lang('message.Select_Internal_Seller')...</option>
                                                @foreach($internalSellers as $internalSeller)
                                                    <option value="{{ $internalSeller->id }}"
                                                        {{ isset($client->internal_id) ? ($client->internal_id == $internalSeller->id ? 'selected' : '') : old('internal_seller') == $internalSeller->id ? 'selected' : ''}}
                                                        >{{ $internalSeller->name }}</option>
                                                @endforeach
                                            </select>
                                    	</div>
                                    </div>
                                    <div class="form-group">
                                         <div class="col-md-2">
                                            <label for="textarea-input" class=" form-control-label">@lang('message.Note')</label>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="note" id="textarea-input" rows="9" placeholder="@lang('message.Note')..." class="form-control">{{ $client->note ?? old('note') }}</textarea>
                                        </div>
                                    </div>
                                    <br /><br />
                                    <div class="box-footer">
                                        <div class="col-md-6 text-left">
                                                <a href="{{ route('client.index') }}"class="btn btn-danger btn-save"><i class="fas fa-arrow-left"></i> @lang('message.Back')</a>
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
