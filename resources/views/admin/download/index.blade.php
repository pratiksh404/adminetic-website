@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Download">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('download') }}" class="btn btn-primary btn-air-primary">Create Download</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.download.download-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.download.scripts')
@endsection
