@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Galleries</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Galleries</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="All Gallery">
    <x-slot name="buttons">
        <a href="{{adminCreateRoute('gallery')}}" class="btn btn-primary btn-air-primary">Create Gallery</a>
    </x-slot>
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