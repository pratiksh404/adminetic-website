@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="package" route="package">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
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
                    <td>{{config('coderz.currency_symbol','Rs.')}}{{$package->package_cost}}</td>
                    <td style="background-color: {{$package->color}};">
                    </td>
                    <td><span class=" badge badge-{{$package->active ? "success" : "danger"}}">
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
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.package.scripts')
@endsection