@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Clients</h3>
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
<x-adminetic-card title="All Client">
    <x-slot name="buttons">
        <a href="{{adminCreateRoute('client')}}" class="btn btn-primary btn-air-primary">Create Client</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr>
                    <td>
                        @if ($client->image)
                        <img src="{{asset('storage/'.$client->image)}}" alt="{{$client->name}}"
                            style="width:64px;height:auto;" class="img-fluid">
                        @else
                        <img src="{{getImagePlaceholder()}}" alt="{{$client->name}}" class="img-fluid"
                            class="img-fluid">
                        @endif
                    </td>
                    <td><a href="{{$client->url ?? "#"}}">{{$client->name}}</a></td>
                    <td>
                        <x-adminetic-action :model="$client" route="client" show="0" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
    </x-adminetic-index-page>
    @endsection

    @section('custom_js')
    @include('website::admin.layouts.modules.client.scripts')
    @endsection