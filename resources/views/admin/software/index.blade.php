@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Software">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('software') }}" class="btn btn-primary btn-air-primary">Create Software</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.software.software-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.software.scripts')
@endsection
