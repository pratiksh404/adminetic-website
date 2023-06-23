@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Testimonial">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('testimonial') }}" class="btn btn-primary btn-air-primary">Create Testimonial</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.testimonial.testimonial-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.testimonial.scripts')
@endsection
