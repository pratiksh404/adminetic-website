@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="video" route="video">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.video.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.video.scripts')
@endsection