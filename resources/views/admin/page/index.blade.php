@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All Pages</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Pages</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="page" route="page">
    <x-slot name="buttons">
        <a href="{{ adminCreateRoute('page') }}" class="btn btn-primary btn-air-primary mx-1">Create
            Page</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered page_datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Position</th>
                    <th>Title</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pages as $page)
                <tr>
                    <td>{{$page->id}}</td>
                    <td>{{$page->position}}</td>
                    <td>{{$page->title}}</td>
                    <td><span
                            class="badge badge-{{$page->active ? "success" : "danger"}}">{{$page->active ? "Active" : "Inactive"}}</span>
                    </td>
                    <td>
                        <x-adminetic-action :model="$page" route="page" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Position</th>
                    <th>Title</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.page.scripts')
@endsection