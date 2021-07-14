@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="gallery" route="gallery">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.gallery.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.gallery.scripts')
@endsection