@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All Teams</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Teams</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="team" route="team">
    <x-slot name="buttons">
        <a href="{{ adminCreateRoute('team') }}" class="btn btn-primary btn-air-primary mx-1">Create
            Team</a>
    </x-slot>
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
</x-adminetic-card>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.team.scripts')
@endsection