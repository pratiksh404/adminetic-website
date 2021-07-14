@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="page" route="page" :model="$page">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.page.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.page.scripts')
@endsection