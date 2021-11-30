@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="popup-title">
        <div class="row">
            <div class="col-6">
                <h3>Pop ups</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Pop ups</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="popup" route="popup">
    <x-slot name="buttons">
        <a href="{{adminCreateRoute('popup')}}" class="btn btn-primary btn-air-primary">Create Popup</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="info-list-tab" data-bs-toggle="tab" href="#info-list"
                    role="tab" aria-controls="info-list" aria-selected="true">List</a></li>
            <li class="nav-item"><a class="nav-link" id="reorder-info-tab" data-bs-toggle="tab" href="#info-reorder"
                    role="tab" aria-controls="info-reorder" aria-selected="false">Reorder Popup</a></li>
        </ul>
        <div class="tab-content" id="info-tabContent">
            <div class="tab-pane fade show active" id="info-list" role="tabpanel" aria-labelledby="info-list-tab">
                <table class="table table-striped table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($popups as $popup)
                        <tr>
                            <td>{{$popup->name ?? 'N/A'}}</td>
                            <td>
                                @if (isset($popup->image))
                                <img src="{{asset('storage/' . $popup->image)}}" alt="{{$popup->name ?? ''}}"
                                    width="120">
                                @else
                                <img src="{{getImagePlaceholder()}}" alt="{{$popup->name ?? ''}}" width="120">
                                @endif
                            </td>
                            <td>
                                <x-adminetic-action :model="$popup" route="popup" />
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
                @livewire('admin.popup.reorder-popup')
            </div>
        </div>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.popup.scripts')
@endsection