@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Service">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('service') }}" class="btn btn-primary btn-air-primary">Create Service</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.service.service-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.service.scripts')
@endsection
