@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Packages</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Packages</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="package" route="package">
    <x-slot name="buttons">
        <a href="{{adminCreateRoute('package')}}" class="btn btn-primary btn-air-primary">Create Package</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="info-list-tab" data-bs-toggle="tab" href="#info-list"
                    role="tab" aria-controls="info-list" aria-selected="true">List</a></li>
            <li class="nav-item"><a class="nav-link" id="reorder-info-tab" data-bs-toggle="tab" href="#info-reorder"
                    role="tab" aria-controls="info-reorder" aria-selected="false">Reorder Package</a></li>
        </ul>
        <div class="tab-content" id="info-tabContent">
            <div class="tab-pane fade show active" id="info-list" role="tabpanel" aria-labelledby="info-list-tab">
                <table class="table table-striped table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Plan</th>
                            <th>Price</th>
                            <th>Color</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($packages as $package)
                        <tr>
                            <td>{{$package->name}}</td>
                            <td>{{$package->package_time}}</td>
                            <td>{{config('adminetic.currency_symbol','Rs.')}}{{$package->package_cost}}</td>
                            <td style="background-color: {{$package->color}};">
                            </td>
                            <td><span class=" badge badge-{{$package->active ? " success" : "danger" }}">
                                    {{$package->active ? "Active" : "Inactive"}}</span>
                            </td>
                            <td>
                                <x-adminetic-action :model="$package" route="package" />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Plan</th>
                            <th>Price</th>
                            <th>Color</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="tab-pane fade" id="info-reorder" role="tabpanel" aria-labelledby="reorder-info-tab">
                @livewire('admin.package.reorder-package')
            </div>
        </div>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.package.scripts')
@endsection