@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All About">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('about') }}" class="btn btn-primary btn-air-primary">Create About</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.about.about-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.about.scripts')
@endsection
