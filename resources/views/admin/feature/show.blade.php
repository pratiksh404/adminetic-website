@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-show-page name="feature" route="feature" :model="$feature">
        <x-slot name="content">
            @if (!is_null($feature->description))
                {!! $feature->description !!}
            @endif
        </x-slot>
        </x-admin.show-page>
    @endsection

    @section('custom_js')
        @include('website::admin.layouts.modules.feature.scripts')
    @endsection
