@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="feature" route="feature" :model="$feature">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.feature.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.feature.scripts')
@endsection