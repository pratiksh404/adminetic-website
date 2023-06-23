@extends(request()->header('layout') ?? 'adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-card title="All Career">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('career') }}" class="btn btn-primary btn-air-primary">Create Career</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.career.career-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.career.scripts')
@endsection
