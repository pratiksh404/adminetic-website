@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="feature" route="feature">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.feature.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.feature.scripts')
@endsection