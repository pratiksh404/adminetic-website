@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-create-page name="testimonial" route="testimonial">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.testimonial.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-create-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.testimonial.scripts')
@endsection