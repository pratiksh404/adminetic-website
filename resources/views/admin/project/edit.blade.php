@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="project" route="project" :model="$project">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.project.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.project.scripts')
@endsection