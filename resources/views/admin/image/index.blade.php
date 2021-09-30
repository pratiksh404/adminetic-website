@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Images</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Images</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="All Image">
    <x-slot name="buttons">
        <a href="{{adminCreateRoute('image')}}" class="btn btn-primary btn-air-primary">Create Image</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Gallery</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($images as $image)
                <tr>
                    <td>
                        @if (isset($image->image))
                        <img src="{{asset($image->thumbnail('image','small'))}}" class="img-fluid">
                        @else
                        <img src="{{getFoodImagePlaceholder()}}" class="img-fluid">
                        @endif
                    </td>
                    <td>{{isset($image->gallery) ? $image->gallery->name : 'All'}}</td>
                    <td>{{$image->type}}</td>
                    <td>
                        <x-adminetic-action :model="$image" route="image" show="0" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Image</th>
                    <th>Gallery</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
    </x-adminetic-index-page>
    @endsection

    @section('custom_js')
    @include('website::admin.layouts.modules.image.scripts')
    @endsection