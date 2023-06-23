@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-create-page name="post" route="post">
        <x-slot name="content">
            {{-- ================================Form================================ --}}
            @include('website::admin.layouts.modules.post.form')
            {{-- =================================================================== --}}
        </x-slot>
        </x-admin.create-page>
    @endsection

    @section('custom_js')
        @include('website::admin.layouts.modules.post.scripts')
    @endsection
