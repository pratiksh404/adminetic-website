@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="image" route="image">
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
@include('admin.layouts.modules.image.scripts')
@endsection