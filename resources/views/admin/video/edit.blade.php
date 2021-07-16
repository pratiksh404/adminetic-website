@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="video" route="video" :model="$video">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.video.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.video.scripts')
@endsection