@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Features</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Features</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="All Faq">
    <x-slot name="buttons">
        <a href="{{adminCreateRoute('feature')}}" class="btn btn-primary btn-air-primary">Create Feature</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="info-list-tab" data-bs-toggle="tab" href="#info-list"
                    role="tab" aria-controls="info-list" aria-selected="true">List</a></li>
            <li class="nav-item"><a class="nav-link" id="reorder-info-tab" data-bs-toggle="tab" href="#info-reorder"
                    role="tab" aria-controls="info-reorder" aria-selected="false">Reorder Feature</a></li>
        </ul>
        <div class="tab-content" id="info-tabContent">
            <div class="tab-pane fade show active" id="info-list" role="tabpanel" aria-labelledby="info-list-tab">
                <table class="table table-striped table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Icon Image</th>
                            <th>Icon</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($features as $feature)
                        <tr>
                            <td>
                                @if (isset($feature->image))
                                <img src="{{asset('storage/' . $feature->image)}}" alt="{{$feature->name}}"
                                    class="img-fluid" width="120">
                                @else
                                <img src="{{getImagePlaceholder()}}" alt="{{$feature->name}}" class="img-fluid"
                                    width="120">
                                @endif
                            </td>
                            <td><i class="{{$feature->icon ?? 'fa fa-burn'}}"></i></td>
                            <td>{{$feature->name}}</td>
                            <td>
                                <x-adminetic-action :model="$feature" route="feature" />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="tab-pane fade" id="info-reorder" role="tabpanel" aria-labelledby="reorder-info-tab">
                @livewire('admin.feature.reorder-feature')
            </div>
        </div>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.feature.scripts')
@endsection