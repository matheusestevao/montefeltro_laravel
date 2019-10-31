@extends('layouts.app')

@section('right_panel')
    @include('layouts.right_panel')
@endsection

@section('left_panel')
    @include('layouts.left_panel')
@endsection

@section('content')
    @can('clients_list')

    @else
        <script>
            window.location.href = "{{ route('home') }}";
        </script>
    @endcan
