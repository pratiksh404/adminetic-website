@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Projects</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Projects</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="project" route="project">
    <x-slot name="buttons">
        <a href="{{adminCreateRoute('project')}}" class="btn btn-primary btn-air-primary">Create Project</a>
    </x-slot>
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
                        <x-adminetic-action :model="$project" route="project" />
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
</x-adminetic-card>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.project.scripts')
@endsection