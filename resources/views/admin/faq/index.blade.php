@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="faq" route="faq">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered faq_datatable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Position</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faqs as $faq)
                <tr>
                    <td>{{$faq->id}}</td>
                    <td>{{$faq->position}}</td>
                    <td>{{$faq->created_at->toDateTimeString()}}</td>
                    <td>
                        <x-adminetic-action :model="$faq" route="faq" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.faq.scripts')
@endsection