@extends(request()->header('layout') ?? 'adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-edit-page name="attribute" route="attribute" :model="$attribute">
        <x-slot name="content">
            {{-- ================================Form================================ --}}
            @include('website::admin.layouts.modules.attribute.form')
            {{-- =================================================================== --}}
        </x-slot>
    </x-adminetic-edit-page>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.attribute.scripts')
@endsection
