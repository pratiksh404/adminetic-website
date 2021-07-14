@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="page" route="page">
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
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.page.scripts')
@endsection