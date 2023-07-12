@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')

    <x-adminetic-card title="All Category">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('category') }}" class="btn btn-primary btn-air-primary">Create Category</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.category.category-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.category.scripts')
@endsection
