@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Client">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('client') }}" class="btn btn-primary btn-air-primary">Create Client</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.client.client-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.client.scripts')
@endsection
