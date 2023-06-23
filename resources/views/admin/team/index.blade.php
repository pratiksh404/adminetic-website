@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Team">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('team') }}" class="btn btn-primary btn-air-primary">Create Team</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.team.team-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.team.scripts')
@endsection
