@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All Videos</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Videos</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="video" route="video">
    <x-slot name="buttons">
        <a href="{{ adminCreateRoute('video') }}" class="btn btn-primary btn-air-primary mx-1">Create
            Video</a>
    </x-slot>
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
</x-adminetic-card>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.video.scripts')
@endsection