@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="image" route="image" :model="$image">
    <x-slot name="content">

    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.image.scripts')
@endsection