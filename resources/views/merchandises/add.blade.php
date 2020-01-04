@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
    @can('merchandises_add')
        <style type="text/css">
            span.arrow {
                margin-left: 6px;
                height:17px;
            }
            label.error {
                height:17px;
                margin-left:9px;
                padding:1px 5px 0px 5px;
                font-size:small;
                color: red;
                font-weight: bold;
            }
        </style>
        <script>
            let idenRecord = 0;

            function insertMerchadise()
            {
                $('.btn-success').removeClass('d-none');
                var clone = $("#boxMerchadise tbody").html();

                clone= clone.replace(/\[X\]/g, "["+idenRecord+"]");
                clone= clone.replace(/__X/g, "__"+idenRecord);

                $("#boxViewMerchadise tbody").append(clone);

                idenRecord++;
            };

            function removeMerchadise(o)
            {
                $(o.parentNode.parentNode).remove();
            };
        </script>
        <div class="content mt-3">
            @include('includes.alerts')
            <br />
            <div class="animated fadeIn">
                <div class="col-md-12">
                    <div class="row">
                        <div class="card col-md-12">
                            <div class="card-body card-block">
                                <form action="{{ route('merchandise.store') }}" method="post" id="merchadise_form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-lg-12 form-group" id="div-tel">
                                        <a class="btn btn-success" onclick="insertMerchadise()" style="color: white">@lang('message.Add Merchandise')</a>

                                        <table class="table table-striped table-bordered" id="boxMerchadise" style="display: none">
                                            <thead>
                                                <tr>
                                                    <th>@lang('message.Client')*</th>
                                                    <th>@lang('message.Service Order')*</th>
                                                    <th>@lang('message.Amount')*</th>
                                                    <th>@lang('message.Category')*</th>
                                                    <th>@lang('message.Input')*</th>
                                                    <th>@lang('message.Output')</th>
                                                    <th>@lang('message.Withdrawn By')</th>
                                                    <th>@lang('message.Note')</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <input type="hidden" name="insertMechandise_idComponent[X]" value="">
                                                    <td>
                                                        <select name="insertMechandise_client[X]" class="form-control insertMechandise_client">
                                                            <option value=''>@lang('message.Select')...</option>
                                                            @foreach($clients as $client)
                                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="insertMechandise_service_order[X]" class="insertMechandise_service_order" placeholder="@lang('message.Service Order')">
                                                    </td>
                                                    <td>
                                                        <input type="number" min="1" name="insertMechandise_amount[X]" class="insertMechandise_amount" placeholder="@lang('message.Amount')">
                                                    </td>
                                                    <td>
                                                        <select name="insertMechandise_category[X]" class="form-control insertMechandise_category">
                                                            <option value=''>@lang('message.Select')...</option> 
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="date" name="insertMechandise_input[X]" class="form-control date date-input insertMechandise_input">
                                                    </td>
                                                    <td>
                                                        <input type="date" name="insertMechandise_output[X]" class="form-control date date-output insertMechandise_output">
                                                    </td>
                                                    <td>
                                                        <select name="insertMechandise_withdrawn[X]" class="form-control insertMechandise_withdrawn">
                                                            <option value=''>@lang('message.Select')...</option>
                                                            @foreach($users as $user)
                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <textarea name="insertMechandise_note[X]" cols="19" placeholder="@lang('message.Note')..." class="form-control insertMechandise_note"></textarea>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-danger btn-remove" onclick="removeMerchadise(this)" style="color: white">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                         </table>
                                        <table class="table table-striped table-bordered" id="boxViewMerchadise" style="margin-top: 20px">
                                            <thead>
                                                <tr>
                                                    <th>@lang('message.Client')*</th>
                                                    <th>@lang('message.Service Order')*</th>
                                                    <th>@lang('message.Amount')*</th>
                                                    <th>@lang('message.Category')*</th>
                                                    <th>@lang('message.Input')*</th>
                                                    <th>@lang('message.Output')</th>
                                                    <th>@lang('message.Withdrawn By')</th>
                                                    <th>@lang('message.Note')</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div><!--DIV componente Merchandise -->
                                    <br /><br />
                                    <div class="box-footer">
                                        <div class="col-md-6 text-left">
                                                <a href="{{ route('merchandise.index') }}"class="btn btn-danger btn-save"><i class="fas fa-arrow-left"></i> @lang('message.Back')</a>
                                            </div>
                                        <div class="col-md-6 text-right">
                                            <button type="submit" class="btn btn-success btn-save d-none"><i class="fa fa-save"></i> @lang('message.Save')</button>
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

            <script>
                $.validator.addMethod("clidRequired", $.validator.methods.required, "@lang('message.Client is required.')");
                $.validator.addMethod("ordRequired", $.validator.methods.required, "@lang('message.Service Order is required.')");
                $.validator.addMethod("amoRequired", $.validator.methods.required, "@lang('message.Amount is required.')");
                $.validator.addMethod("catRequired", $.validator.methods.required, "@lang('message.Category is required.')");
                $.validator.addMethod("inpRequired", $.validator.methods.required, "@lang('message.Input is required.')");

                jQuery.validator.addClassRules('insertMechandise_client', {
                    clidRequired: true
                });
                jQuery.validator.addClassRules('insertMechandise_service_order', {
                    ordRequired: true
                });
                jQuery.validator.addClassRules('insertMechandise_amount', {
                    amoRequired: true
                });
                jQuery.validator.addClassRules('insertMechandise_category', {
                    catRequired: true
                });
                jQuery.validator.addClassRules('insertMechandise_input', {
                    inpRequired: true
                });

                $("#merchadise_form").validate({
                    errorPlacement: function(label, element) {
                        label.addClass('arrow');
                        label.insertAfter(element);
                    },
                    wrapper: 'span'
                });
                
            </script>             
        @endpush
    @else
        <script>
            window.location.href = "{{ route('home') }}";
        </script>
    @endcan
@endsection
