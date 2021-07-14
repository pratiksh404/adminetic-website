@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="counter" route="counter" :model="$counter">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.counter.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.counter.scripts')
@endsection