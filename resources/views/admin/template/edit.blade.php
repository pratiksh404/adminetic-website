@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="template" route="template" :model="$template">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.template.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.template.scripts')
@endsection