@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-edit-page name="team" route="team" :model="$team">
        <x-slot name="content">
            {{-- ================================Form================================ --}}
            @include('website::admin.layouts.modules.team.form')
            {{-- =================================================================== --}}
        </x-slot>
        </x-admin.edit-page>
    @endsection

    @section('custom_js')
        @include('website::admin.layouts.modules.team.scripts')
    @endsection
