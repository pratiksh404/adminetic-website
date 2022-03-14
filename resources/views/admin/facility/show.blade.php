@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="facility" route="facility" :model="$facility">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body p-3">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <b>Code :</b> <span class="text-muted"> {{$facility->code ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Name :</b> <span class="text-muted"> {{$facility->name ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Slug :</b> <span class="text-muted"> {{$facility->slug ?? 'N/A'}}</span>
                            </li>
                            @isset($facility->icon)
                            <li class="list-group-item">
                                <b>Icon :</b> <i class="{{$facility->icon}}"></i>
                            </li>
                            @endisset
                            @isset($facility->icon_image)
                            <li class="list-group-item">
                                <b>Icon Image :</b>
                                <hr>
                                <img src="{{asset('storage/' . $facility->icon_image)}}" alt="{{$facility->name}}"
                                    class="img-fluid">
                            </li>
                            @endisset
                            @isset($facility->image)
                            <li class="list-group-item">
                                <b>Facility Image :</b>
                                <hr>
                                <img src="{{asset('storage/' . $facility->image)}}" alt="{{$facility->name}}"
                                    class="img-fluid">
                            </li>
                            @endisset
                            @isset($facility->category)
                            <li class="list-group-item">
                                <b>Category :</b> <span class="text-muted">{{$facility->category->name ??
                                    'N/A'}}</span>
                            </li>
                            @endisset
                            <li class="list-group-item">
                                <b>Active :</b> <span
                                    class="badge badge-{{$facility->active ? 'success' : 'danger'}}">{{$facility->active
                                    ? 'Yes' : 'No'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Position :</b> <span class="text-muted"> {{$facility->position ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b> Meta Name:</b> <span class="text-muted"> {{$facility->meta_name ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Meta Description :</b> <span class="text-muted">
                                    {{$facility->meta_description ?? 'N/A'}}</span>
                            </li>
                            @isset($facility->meta_keywords)
                            <li class="list-group-item">
                                <b>Meta Keywords :</b>
                                <hr>
                                @foreach ($facility->meta_keywords as $keyword)
                                <span class="badge badge-primary">{{$keyword}}</span>
                                @endforeach
                            </li>
                            @endisset
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                @isset($facility->excerpt)
                <div class="card shadow-lg">
                    <div class="card-body p-3">
                        <b>Excerpt</b>
                        <hr>
                        {{$facility->excerpt}}
                    </div>
                </div>
                @endisset
                @isset($facility->description)
                <div class="card shadow-lg">
                    <div class="card-body p-3">
                        <b>Description</b>
                        <hr>
                        {!! $facility->description !!}
                    </div>
                </div>
                @endisset
            </div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.facility.scripts')
@endsection