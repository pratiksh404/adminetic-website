@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="faq" route="faq">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.faq.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.faq.scripts')
@endsection