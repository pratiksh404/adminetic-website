@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="video" route="video">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Gallery</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videos as $video)
                <tr>
                    <td>
                        @if (isset($video->thumbnail))
                        <img src="{{asset($video->thumbnail('thumbnail','small'))}}" class="img-fluid" width="60">
                        @else
                        <img src="{{getImagePlaceholder()}}" class="img-fluid">
                        @endif
                    </td>
                    <td>{{$video->name ?? 'N/A'}}</td>
                    <td>{{$video->url}}</td>
                    <td>{{isset($video->gallery) ? $video->gallery->name : "N/A"}}</td>
                    <td>
                        <x-adminetic-action :model="$video" route="video" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Gallery</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.video.scripts')
@endsection