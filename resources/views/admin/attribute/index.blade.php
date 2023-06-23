@extends(request()->header('layout') ?? 'adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-card title="All Attributes">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('attribute') }}" class="btn btn-primary btn-air-primary">Create Attribute</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.attribute.attribute-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.attribute.scripts')
@endsection
