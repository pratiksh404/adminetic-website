@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="package" route="package">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.package.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.package.scripts')
@endsection