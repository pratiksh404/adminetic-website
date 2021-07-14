@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="project" route="project">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.project.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.project.scripts')
@endsection