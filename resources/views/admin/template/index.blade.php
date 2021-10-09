@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="template-title">
        <div class="row">
            <div class="col-6">
                <h3>Templates</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Templates</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="template" route="template">
    <x-slot name="buttons">
        <a href="{{adminCreateRoute('template')}}" class="btn btn-primary btn-air-primary">Create Template</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($templates as $template)
                <tr>
                    <td>{{ $template->name }}</td>
                    <td><span
                            class="badge badge-{{ $template->active ? 'success' : 'danger' }}">{{ $template->active ? 'Active' : 'Inactive' }}</span>
                    </td>
                    <td>
                        <x-adminetic-action :model="$template" route="template" show="0" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <th>Name</th>
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
    @include('website::admin.layouts.modules.template.scripts')
    @endsection