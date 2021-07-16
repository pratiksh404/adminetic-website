@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="image" route="image">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.image.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.image.scripts')
@endsection