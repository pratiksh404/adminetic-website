@extends('adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-show-page name="counter" route="counter" :model="$counter">
        <x-slot name="content">
       
        </x-slot>
    </x-adminetic-show-page>

@endsection

@section('custom_js')
    @include('admin.layouts.modules.counter.scripts')
@endsection
