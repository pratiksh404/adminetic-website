@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="package" route="package" :model="$package">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.package.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.package.scripts')
@endsection