@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="category" route="category" :model="$category">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.category.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.category.scripts')
@endsection