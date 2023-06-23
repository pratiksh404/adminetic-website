@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Counter">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('counter') }}" class="btn btn-primary btn-air-primary">Create Counter</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.counter.counter-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.counter.scripts')
@endsection
