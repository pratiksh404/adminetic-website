@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="block" route="block" :model="$block">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.block.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.block.scripts')
@endsection