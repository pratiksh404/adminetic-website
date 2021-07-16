@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="team" route="team">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.team.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.team.scripts')
@endsection