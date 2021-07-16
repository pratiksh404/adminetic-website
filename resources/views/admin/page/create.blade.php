@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="page" route="page">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.page.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.page.scripts')
@endsection