@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All Categories</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Categories</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="category" route="category">
    <x-slot name="buttons">
        <a href="{{ adminCreateRoute('category') }}" class="btn btn-primary btn-air-primary mx-1">Create
            Category</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered category_datatable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Position</th>
                    <th>Category</th>
                    <th>Parent</th>
                    <th>Model</th>
                    <th>Active</th>
                    <th>Color</th>
                    <th>Icon</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->position}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->parent->name ?? 'N/A'}}</td>
                    <td>{{$category->model}}</td>
                    <td><span
                            class="badge badge-{{$category->active ? 'success' : 'danger'}}">{{$category->active ? 'Active' : 'Inactive'}}</span>
                    </td>
                    <td style="background-color: {{$category->color}}"></td>
                    <td>
                        <h3><i class="{{$category->icon}}"></i></h3>
                    </td>
                    <td>
                        <x-adminetic-action :model="$category" route="category" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>id</th>
                    <th>Position</th>
                    <th>Category</th>
                    <th>Parent</th>
                    <th>Model</th>
                    <th>Active</th>
                    <th>Color</th>
                    <th>Icon</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.category.scripts')
@endsection