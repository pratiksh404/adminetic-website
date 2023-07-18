@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All History">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('history') }}" class="btn btn-primary btn-air-primary">Create History</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.history.history-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.history.scripts')
@endsection
