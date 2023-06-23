@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-show-page name="package" route="package" :model="$package">
        <x-slot name="content">
            @if (!is_null($package->description))
                {!! $package->description !!}
            @endif
        </x-slot>
        </x-admin.show-page>
    @endsection

    @section('custom_js')
        @include('website::admin.layouts.modules.package.scripts')
    @endsection
