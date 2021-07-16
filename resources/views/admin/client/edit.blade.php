@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="client" route="client" :model="$client">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.client.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.client.scripts')
@endsection