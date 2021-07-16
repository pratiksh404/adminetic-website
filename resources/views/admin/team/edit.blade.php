@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="team" route="team" :model="$team">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.team.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.team.scripts')
@endsection