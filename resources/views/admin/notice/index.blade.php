@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Notice">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('notice') }}" class="btn btn-primary btn-air-primary">Create Notice</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.notice.notice-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.notice.scripts')
@endsection
