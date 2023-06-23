@extends(request()->header('layout') ?? 'adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-create-page name="career" route="career">
        <x-slot name="content">
            {{-- ================================Form================================ --}}
            @include('website::admin.layouts.modules.career.form')
            {{-- =================================================================== --}}
        </x-slot>
    </x-adminetic-create-page>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.career.scripts')
@endsection
