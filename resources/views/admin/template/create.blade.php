@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="template" route="template">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.template.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.template.scripts')
@endsection