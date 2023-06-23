@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Facility">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('facility') }}" class="btn btn-primary btn-air-primary">Create Facility</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.facility.facility-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.facility.scripts')
@endsection
