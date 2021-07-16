@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="image" route="image" :model="$image">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.image.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.image.scripts')
@endsection