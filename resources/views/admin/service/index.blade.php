@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All Services</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Clients</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="service" route="service">
    <x-slot name="buttons">
        <a href="{{ adminCreateRoute('service') }}" class="btn btn-primary btn-air-primary mx-1">Create
            Service</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered service_datatable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Position</th>
                    <th>Name</th>
                    <th>Icon</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                <tr>
                    <td>{{$service->id}}</td>
                    <td>{{$service->position}}</td>
                    <td>{{\Illuminate\Support\Str::limit($service->name,60)}}</td>
                    <td><i class="{{$service->icon}}"></i></td>
                    <td>
                        <x-adminetic-action :model="$service" route="service" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Code</th>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.service.scripts')
@endsection