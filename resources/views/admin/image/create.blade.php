@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="image" route="image">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.image.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.image.scripts')
@endsection