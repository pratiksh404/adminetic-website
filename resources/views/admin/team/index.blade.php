@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Teams</h3>
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
        <a href="{{adminCreateRoute('team')}}" class="btn btn-primary btn-air-primary">Create Team</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="info-list-tab" data-bs-toggle="tab" href="#info-list"
                    role="tab" aria-controls="info-list" aria-selected="true">List</a></li>
            <li class="nav-item"><a class="nav-link" id="reorder-info-tab" data-bs-toggle="tab" href="#info-reorder"
                    role="tab" aria-controls="info-reorder" aria-selected="false">Reorder Team</a></li>
        </ul>
        <div class="tab-content" id="info-tabContent">
            <div class="tab-pane fade show active" id="info-list" role="tabpanel" aria-labelledby="info-list-tab">
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
                                <img src="{{asset($team->thumbnail('image','small'))}}" alt="{{$team->name}}"
                                    class="img-fluid" style="width: 60px;height:auto">
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
            </div>
            <div class="tab-pane fade" id="info-reorder" role="tabpanel" aria-labelledby="reorder-info-tab">
                @livewire('admin.team.reorder-team')
            </div>
        </div>
        {{-- =================================================================== --}}
    </x-slot>
    </x-adminetic-index-page>
    @endsection

    @section('custom_js')
    @include('website::admin.layouts.modules.team.scripts')
    @endsection