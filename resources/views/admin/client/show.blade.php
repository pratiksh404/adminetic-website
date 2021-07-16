@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="client" route="client" :model="$client">
    <x-slot name="content">

    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.client.scripts')
@endsection