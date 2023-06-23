@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Popup">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('popup') }}" class="btn btn-primary btn-air-primary">Create Popup</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.popup.popup-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.popup.scripts')
@endsection
