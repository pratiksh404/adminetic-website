@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="gallery" route="gallery" :model="$gallery">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.gallery.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.gallery.scripts')
@endsection