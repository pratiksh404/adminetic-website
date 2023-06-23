@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Gallery">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('gallery') }}" class="btn btn-primary btn-air-primary">Create Gallery</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.gallery.gallery-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.gallery.scripts')
@endsection
