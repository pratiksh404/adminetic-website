@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="template" route="template" :model="$template">
    <x-slot name="content">

    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.template.scripts')
@endsection