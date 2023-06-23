@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Page">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('page') }}" class="btn btn-primary btn-air-primary">Create Page</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.page.page-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.page.scripts')
@endsection
