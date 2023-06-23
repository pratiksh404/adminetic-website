@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-create-page name="package" route="package">
        <x-slot name="content">
            {{-- ================================Form================================ --}}
            @include('website::admin.layouts.modules.package.form')
            {{-- =================================================================== --}}
        </x-slot>
        </x-admin.create-page>
    @endsection

    @section('custom_js')
        @include('website::admin.layouts.modules.package.scripts')
    @endsection
