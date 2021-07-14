@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="faq" route="faq" :model="$faq">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('admin.layouts.modules.faq.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.faq.scripts')
@endsection