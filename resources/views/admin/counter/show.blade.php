@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-show-page name="counter" route="counter" :model="$counter">
        <x-slot name="content">

        </x-slot>
        </x-admin.show-page>
    @endsection

    @section('custom_js')
        @include('website::admin.layouts.modules.counter.scripts')
    @endsection
