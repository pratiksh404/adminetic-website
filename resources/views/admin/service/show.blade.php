@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-show-page name="service" route="service" :model="$service">
        <x-slot name="content">
            @if (!is_null($service->description))
                {!! $service->description !!}
            @endif
        </x-slot>
        </x-admin.show-page>
    @endsection

    @section('custom_js')
        @include('website::admin.layouts.modules.service.scripts')
    @endsection
