@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="team" route="team">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Priority</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teams as $team)
                <tr>
                    <td>
                        @if (isset($team->image))
                        <img src="{{asset($team->thumbnail('image','small'))}}" alt="{{$team->name}}" class="img-fluid"
                            style="width: 60px;height:auto">
                        @else
                        <img src="{{getImagePlaceholder()}}" alt="{{$team->name}}" class="img-fluid"
                            style="width: 60px;height:auto">
                        @endif
                    </td>
                    <td>{{$team->name}}</td>
                    <td>{{$team->designation}}</td>
                    <td>{{$team->priority}}</td>
                    <td>
                        <x-adminetic-action :model="$team" route="team" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Priority</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.team.scripts')
@endsection