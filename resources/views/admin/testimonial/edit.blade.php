@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-edit-page name="testimonial" route="testimonial" :model="$testimonial">
    <x-slot name="content">
        {{-- ================================Form================================ --}}
        @include('website::admin.layouts.modules.testimonial.edit_add')
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-edit-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.testimonial.scripts')
@endsection