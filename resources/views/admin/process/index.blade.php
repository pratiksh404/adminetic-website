@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Process">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('process') }}" class="btn btn-primary btn-air-primary">Create Process</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.process.process-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.process.scripts')
@endsection
