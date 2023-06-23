@extends(request()->header('layout') ?? 'adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-edit-page name="career" route="career" :model="$career">
        <x-slot name="content">
            {{-- ================================Form================================ --}}
            @include('website::admin.layouts.modules.career.edit_add')
            {{-- =================================================================== --}}
        </x-slot>
    </x-adminetic-edit-page>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.career.scripts')
@endsection
