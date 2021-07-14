@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="counter" route="counter">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.counter.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.counter.scripts')
@endsection