@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Events</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Events</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="All Event">
    <x-slot name="buttons">
        <a href="{{adminCreateRoute('event')}}" class="btn btn-primary btn-air-primary">Create Event</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Event Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                <tr>
                    <td>
                        @if (isset($event->image))
                        <img src="{{asset($event->thumbnail('image','small'))}}" alt="{{$event->name}}"
                            class="img-fluid">
                        @else
                        <img src="{{getImagePlaceholder()}}" alt="{{$event->name}}" class="img-fluid">
                        @endif
                    </td>
                    <td>{{\Illuminate\Support\Str::limit($event->name,30)}}</td>
                    <td>
                        {{$event->single_date ? $event->event_date->toFormattedDateString() : $event->interval}}
                    </td>
                    <td>
                        <x-adminetic-action :model="$event" route="event" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Event Date</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.event.scripts')
@endsection