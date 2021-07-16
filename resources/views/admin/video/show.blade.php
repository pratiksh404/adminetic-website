@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="video" route="video" :model="$video">
    <x-slot name="content">

    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.video.scripts')
@endsection