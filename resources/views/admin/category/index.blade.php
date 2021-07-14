@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="category" route="category">
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
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.category.scripts')
@endsection