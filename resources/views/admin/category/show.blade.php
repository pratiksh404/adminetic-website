@extends('adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-show-page name="category" route="category" :model="$category">
        <x-slot name="content">
       
        </x-slot>
    </x-adminetic-show-page>

@endsection

@section('custom_js')
    @include('admin.layouts.modules.category.scripts')
@endsection
