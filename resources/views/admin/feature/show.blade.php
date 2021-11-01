@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="feature" route="feature" :model="$feature">
    <x-slot name="content">
        {!! $feature->description !!}
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.feature.scripts')
@endsection