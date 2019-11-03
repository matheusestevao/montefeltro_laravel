@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
    @can('merchandises_add')
        <script>
            let idenRecord = 0;

            function insertMerchadise()
            {
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
                                @if(!isset($merchandise))
                                    <form action="{{ route('merchandise.store') }}" method="post" enctype="multipart/form-data">
                                @else
                                    <form action="{{ route('merchandise.update', $merchandise->id) }}" method="post" enctype="multipart/form-data">
                                @endif
                                    @csrf
                                    <div class="col-lg-12 form-group" id="div-tel">
                                        <a class="btn btn-success" onclick="insertMerchadise()" style="color: white">@lang('message.Add Merchandise')</a>

                                        <table class="table table-striped table-bordered" id="boxMerchadise" style="display: none">
                                            <thead>
                                                <tr>
                                                    <th>@lang('message.Client')</th>
                                                    <th>@lang('message.Service Order')</th>
                                                    <th>@lang('message.Category')</th>
                                                    <th>@lang('message.Input')</th>
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
                                                        <select name="insertMechandise_client[X]" class="form-control">
                                                            <option value=''>@lang('message.Select')...</option>
                                                            @foreach($clients as $client)
                                                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="insertMechandise_service_order[X]" placeholder="@lang('message.Service Order')" value="">
                                                    </td>
                                                    <td>
                                                        <select name="insertMechandise_category[X]" class="form-control">
                                                            <option value=''>@lang('message.Select')...</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="date" name="insertMechandise_input[X]" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="date" name="insertMechandise_output[X]" class="form-control">
                                                    </td>
                                                    <td>
                                                        <select name="insertMechandise_withdrawn[X]" class="form-control">
                                                            <option value=''>@lang('message.Select')...</option>
                                                            @foreach($users as $user)
                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <textarea name="note" id="textarea-input" cols="19" placeholder="@lang('message.Note')..." class="form-control"></textarea>
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
                                                    <th>@lang('message.Client')</th>
                                                    <th>@lang('message.Service Order')</th>
                                                    <th>@lang('message.Category')</th>
                                                    <th>@lang('message.Input')</th>
                                                    <th>@lang('message.Output')</th>
                                                    <th>@lang('message.Withdrawn By')</th>
                                                    <th>@lang('message.Note')</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $countMechandise = 0;
                                                if(isset($merchandises)) : foreach ($merchandises as $merchandise):?>
                                                    <tr>
                                                        <input type="hidden" name="insertMechandise_id[<?=$count?>]" value="<?=$merchandise->id?>">
                                                        <input type="text" name="insertMechandise[<?=$count?>]" value="">
                                                        <td>
                                                            <select name="insereTelefonePessoa_operadora[<?=$count?>]" class="form-control">
                                                                <option value=''>@lang('message.Select')...</option>
                                                                @foreach($categories as $category)
                                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="tel" name="insereTelefonePessoa_numTelefone[<?=$count?>]" id="numTelefone" class="form-control numTelefone" value="<?=$infoPhone->phone?>">
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="insereTelefonePessoa_whatsapp[<?=$count?>]" value='0'> @lang('message.No')&nbsp;&nbsp;&nbsp;
                                                            <input type="radio" name="insereTelefonePessoa_whatsapp[<?=$count?>]" value='1'> @lang('message.Yes')
                                                        </td>
                                                        <td>
                                                            <input type="radio" name="insereTelefonePessoa_telprincipal[<?=$count?>]" value='0'> @lang('message.No')&nbsp;&nbsp;&nbsp;
                                                            <input type="radio" name="insereTelefonePessoa_telprincipal[<?=$count?>]" value='1'> @lang('message.Yes')
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-danger btn-remove" onclick="removerTelefone(this)"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                $countMechandise++;
                                                endforeach; endif;?>
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
