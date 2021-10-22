@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Blocks</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Blocks</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="All Block">
    <x-slot name="buttons">
        <a href="{{adminCreateRoute('block')}}" class="btn btn-primary btn-air-primary">Create Block</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="info-list-tab" data-bs-toggle="tab" href="#info-list"
                    role="tab" aria-controls="info-list" aria-selected="true">List</a></li>
            <li class="nav-item"><a class="nav-link" id="reorder-info-tab" data-bs-toggle="tab" href="#info-reorder"
                    role="tab" aria-controls="info-reorder" aria-selected="false">Reorder Block</a></li>
            <li class="nav-item"><a class="nav-link" id="block-vc-tab" data-bs-toggle="tab" href="#block-vc" role="tab"
                    aria-controls="block-vc" aria-selected="false">Block Version Control</a></li>
        </ul>
        <div class="tab-content" id="info-tabContent">
            <div class="tab-pane fade show active" id="info-list" role="tabpanel" aria-labelledby="info-list-tab">
                <table class="table table-striped table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Theme</th>
                            <th>Type</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Page</th>
                            <th>Version</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blocks as $block)
                        <tr>
                            <td>Theme {{$block->theme}}</td>
                            <td>{{$block->type}}</td>
                            <td>
                                @if (isset($block->image))
                                <img src="{{asset('storage/' . $block->image)}}" alt="{{$block->name}}" width="120"
                                    class="img-fluid">
                                @else
                                @if (isset(($block->setting())->image))
                                <img src="{{asset(($block->setting())->image)}}" alt="{{$block->name}}" width="120"
                                    class="img-fluid">
                                @else
                                <img src="{{getImagePlaceholder()}}" alt="{{$block->name}}" width="120"
                                    class="img-fluid">
                                @endif
                                @endif
                            </td>
                            <td>{{$block->name}}</td>
                            <td>{{$block->location ?? 'N/A'}}</td>
                            <td>{{$block->page ?? 'N/A'}}</td>
                            <td>v{{$block->version ?? 'N/A'}}</td>
                            <td><span class="badge badge-{{$block->active ? 'success' : 'danger'}}">{{$block->active ?
                                    'Active' : 'Inactive'}}</span>
                            </td>
                            <td>
                                <x-adminetic-action :model="$block" route="block" />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Theme</th>
                            <th>Type</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Page</th>
                            <th>Version</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="tab-pane fade" id="info-reorder" role="tabpanel" aria-labelledby="reorder-info-tab">
                @livewire('admin.block.reorder-block')
            </div>
            <div class="tab-pane fade" id="block-vc" role="tabpanel" aria-labelledby="block-vc-tab">
                @livewire('admin.block.block-vc')
            </div>
        </div>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.block.scripts')
@endsection