@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Slider">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('slider') }}" class="btn btn-primary btn-air-primary">Create Slider</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.slider.slider-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.slider.scripts')
@endsection
