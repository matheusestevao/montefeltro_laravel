@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
        <div class="content mt-3">
            @include('includes.alerts')
            
            <b>{{ __('message.Hello') }}, {{ auth::user()->name }}</b>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    @push('dashboard_css')
    	<link rel="stylesheet" href="{{ asset('libs/jqvmap/dist/jqvmap.min.css') }}">
    @endpush

    @push('dashboard_js')
    	<script src="{{ asset('js/dashboard.js') }}"></script>
    @endpush
@stop



