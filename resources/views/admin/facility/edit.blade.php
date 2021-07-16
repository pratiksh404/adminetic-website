@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="facility" route="facility" :model="$facility">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.facility.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.facility.scripts')
@endsection