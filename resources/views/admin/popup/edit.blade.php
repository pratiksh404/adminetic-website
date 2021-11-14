@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="popup" route="popup" :model="$popup">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.popup.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.popup.scripts')
@endsection