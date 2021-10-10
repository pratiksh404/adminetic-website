@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="event" route="event">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.event.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.event.scripts')
@endsection