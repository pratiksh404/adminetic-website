@extends(request()->header('layout') ?? 'adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-show-page name="attribute" route="attribute" :model="$attribute">
        <x-slot name="content">

        </x-slot>
    </x-adminetic-show-page>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.attribute.scripts')
@endsection
