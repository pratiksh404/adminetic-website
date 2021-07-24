@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All Counters</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Counters</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="counter" route="counter">
    <x-slot name="buttons">
        <a href="{{ adminCreateRoute('counter') }}" class="btn btn-primary btn-air-primary mx-1">Create
            Counter</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($counters as $counter)
                <tr>
                    <td>
                        @if ($counter->icon)
                        <img src="{{asset('storage/'.$counter->icon)}}" alt="{{$counter->name}}" class="img-fluid"
                            height="40" width="40">
                        @else
                        <img src="{{getImagePlaceholder()}}" alt="{{$counter->name}}" class="img-fluid" height="40"
                            width="40">
                        @endif
                    </td>
                    <td>{{$counter->name}}</td>
                    <td>{{$counter->value}}</td>
                    <td>
                        <x-adminetic-action :model="$counter" route="counter" show=0 />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Count</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.counter.scripts')
@endsection