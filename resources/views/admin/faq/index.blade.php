@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All FAQ">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('faq') }}" class="btn btn-primary btn-air-primary">Create FAQ</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.faq.faq-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.faq.scripts')
@endsection
