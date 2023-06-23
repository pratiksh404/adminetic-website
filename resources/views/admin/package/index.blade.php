@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Package">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('package') }}" class="btn btn-primary btn-air-primary">Create Package</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.package.package-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.package.scripts')
@endsection
