@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="facility" route="facility">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered facility_datatable">
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
                @foreach ($facilities as $facility)
                <tr>
                    <td>{{$facility->id}}</td>
                    <td>{{$facility->position}}</td>
                    <td>{{\Illuminate\Support\Str::limit($facility->name,60)}}</td>
                    <td><i class="{{$facility->icon}}"></i></td>
                    <td>
                        <x-adminetic-action :model="$facility" route="facility" />
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
@include('admin.layouts.modules.facility.scripts')
@endsection