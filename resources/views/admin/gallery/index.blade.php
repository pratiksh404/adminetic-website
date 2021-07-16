@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="gallery" route="gallery">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Image Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($galleries as $gallery)
                <tr>
                    <td>{{$gallery->name}}</td>
                    <td>{{$gallery->type}}</td>
                    <td>{{$gallery->images_count}}</td>
                    <td>
                        <x-adminetic-action :model="$gallery" route="gallery" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Image Count</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.gallery.scripts')
@endsection