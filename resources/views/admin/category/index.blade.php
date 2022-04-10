@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Categories</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Categories</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="All Category">
    <x-slot name="buttons">
        <a href="{{adminCreateRoute('category')}}" class="btn btn-primary btn-air-primary">Create Category</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="info-list-tab" data-bs-toggle="tab" href="#info-list"
                    role="tab" aria-controls="info-list" aria-selected="true">List</a></li>
            <li class="nav-item"><a class="nav-link" id="profile-info-tab" data-bs-toggle="tab" href="#info-reorder"
                    role="tab" aria-controls="info-reorder" aria-selected="false">Reorder Parent Categories</a></li>
        </ul>
        <div class="tab-content" id="info-tabContent">
            <div class="tab-pane fade show active" id="info-list" role="tabpanel" aria-labelledby="info-list-tab">
                <table class="table table-striped table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Children</th>
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
                            <td>{{$category->name}}</td>
                            <td>
                                <ul>
                                    <li>{{$category->name}}
                                        @isset($category->childrenCategories)
                                        @foreach ($category->childrenCategories->sortBy('position') as $child)
                                        @include('website::admin.layouts.modules.category.tree_child_category',
                                        ['child'
                                        =>
                                        $child,'parent_loop_index'
                                        => 1])
                                        @endforeach
                                        @endisset
                                    </li>
                                </ul>
                            </td>
                            <td>{{$category->model}}</td>
                            <td><span
                                    class="badge badge-{{$category->active ? 'success' : 'danger'}}">{{$category->active
                                    ? 'Active' : 'Inactive'}}</span>
                            </td>
                            <td style="background-color: {{$category->color}}"></td>
                            <td>
                                <h3><i class="{{$category->icon}}"></i></h3>
                            </td>
                            <td>
                                <x-adminetic-action :model="$category" route="category" show="0" />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
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
            </div>
            <div class="tab-pane fade" id="info-reorder" role="tabpanel" aria-labelledby="profile-info-tab">
                @livewire('admin.category.reorder-parent-category')
            </div>
        </div>
        {{-- =================================================================== --}}
    </x-slot>
    </x-adminetic-index-page>
    @endsection

    @section('custom_js')
    @include('website::admin.layouts.modules.category.scripts')
    @endsection