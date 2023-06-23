@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Project">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('project') }}" class="btn btn-primary btn-air-primary">Create Project</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.project.project-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.project.scripts')
@endsection
