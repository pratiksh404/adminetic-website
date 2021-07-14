@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="facility" route="facility">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.facility.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.facility.scripts')
@endsection