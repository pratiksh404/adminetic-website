@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-edit-page name="faq" route="faq" :model="$faq">
        <x-slot name="content">
            {{-- ================================Form================================ --}}
            @include('website::admin.layouts.modules.faq.form')
            {{-- =================================================================== --}}
        </x-slot>
        </x-admin.edit-page>
    @endsection

    @section('custom_js')
        @include('website::admin.layouts.modules.faq.scripts')
    @endsection
