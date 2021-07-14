@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="service" route="service">
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
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.service.scripts')
@endsection