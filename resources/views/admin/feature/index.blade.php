@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Feature">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('feature') }}" class="btn btn-primary btn-air-primary">Create Feature</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.feature.feature-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.feature.scripts')
@endsection
