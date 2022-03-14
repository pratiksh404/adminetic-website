@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="service" route="service" :model="$service">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body p-3">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <b>Code :</b> <span class="text-muted"> {{$service->code ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Name :</b> <span class="text-muted"> {{$service->name ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Slug :</b> <span class="text-muted"> {{$service->slug ?? 'N/A'}}</span>
                            </li>
                            @isset($service->icon)
                            <li class="list-group-item">
                                <b>Icon :</b> <i class="{{$service->icon}}"></i>
                            </li>
                            @endisset
                            @isset($service->icon_image)
                            <li class="list-group-item">
                                <b>Icon Image :</b>
                                <hr>
                                <img src="{{asset('storage/' . $service->icon_image)}}" alt="{{$service->name}}"
                                    class="img-fluid">
                            </li>
                            @endisset
                            @isset($service->image)
                            <li class="list-group-item">
                                <b>Service Image :</b>
                                <hr>
                                <img src="{{asset('storage/' . $service->image)}}" alt="{{$service->name}}"
                                    class="img-fluid">
                            </li>
                            @endisset
                            @isset($service->category)
                            <li class="list-group-item">
                                <b>Category :</b> <span class="text-muted">{{$service->category->name ??
                                    'N/A'}}</span>
                            </li>
                            @endisset
                            <li class="list-group-item">
                                <b>Active :</b> <span
                                    class="badge badge-{{$service->active ? 'success' : 'danger'}}">{{$service->active ?
                                    'Yes' : 'No'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Position :</b> <span class="text-muted"> {{$service->position ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b> Meta Name:</b> <span class="text-muted"> {{$service->meta_name ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Meta Description :</b> <span class="text-muted">
                                    {{$service->meta_description ?? 'N/A'}}</span>
                            </li>
                            @isset($service->meta_keywords)
                            <li class="list-group-item">
                                <b>Meta Keywords :</b>
                                <hr>
                                @foreach ($service->meta_keywords as $keyword)
                                <span class="badge badge-primary">{{$keyword}}</span>
                                @endforeach
                            </li>
                            @endisset
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                @isset($service->excerpt)
                <div class="card shadow-lg">
                    <div class="card-body p-3">
                        <b>Excerpt</b>
                        <hr>
                        {{$service->excerpt}}
                    </div>
                </div>
                @endisset
                @isset($service->description)
                <div class="card shadow-lg">
                    <div class="card-body p-3">
                        <b>Description</b>
                        <hr>
                        {!! $service->description !!}
                    </div>
                </div>
                @endisset
            </div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.service.scripts')
@endsection