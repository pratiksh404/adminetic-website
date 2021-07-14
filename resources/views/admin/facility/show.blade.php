@extends('adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-show-page name="facility" route="facility" :model="$facility">
        <x-slot name="content">
       
        </x-slot>
    </x-adminetic-show-page>

@endsection

@section('custom_js')
    @include('admin.layouts.modules.facility.scripts')
@endsection
