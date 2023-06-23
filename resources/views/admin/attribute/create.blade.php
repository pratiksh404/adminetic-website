@extends(request()->header('layout') ?? 'adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-create-page name="attribute" route="attribute">
        <x-slot name="content">
            {{-- ================================Form================================ --}}
            @include('website::admin.layouts.modules.attribute.form')
            {{-- =================================================================== --}}
        </x-slot>
    </x-adminetic-create-page>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.attribute.scripts')
@endsection
