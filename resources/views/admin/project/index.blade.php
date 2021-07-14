@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="project" route="project">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Client</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                <tr>
                    <td>
                        @if (isset($project->image))
                        <img src="{{asset($project->thumbnail('image','small'))}}" alt="{{$project->name}}"
                            class="img-fluid" width="60px">
                        @else
                        <img src="{{getImagePlaceholder()}}" alt="{{$project->name}}" class="img-fluid" width="60px">
                        @endif
                    </td>
                    <td>{{$project->name}}</td>
                    <td>{{$project->client}}</td>
                    <td>
                        <x-action :model="$project" route="project" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Client</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.project.scripts')
@endsection