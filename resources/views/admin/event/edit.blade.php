@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="event" route="event" :model="$event">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.event.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.event.scripts')
@endsection