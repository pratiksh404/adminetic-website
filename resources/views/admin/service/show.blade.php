@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="service" route="service" :model="$service">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="row">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-2">
                                    <b>Service Icon : </b>
                                    @if (isset($service->icon))
                                    <h3><i class="{{$service->icon}}"></i></h3>
                                    @endif
                                </div>
                                <br>
                                @if (isset($service->image))
                                <div class="col-lg-12 mb-2">
                                    <b>Service Image</b>
                                    <hr>
                                    <img src="{{asset('storage/'. $service->image)}}" alt="{{$service->name}}"
                                        class="img-fluid">
                                </div>
                                @endif
                                @if (isset($service->icon_image))
                                <div class="col-lg-12">
                                    <b>Service Icon PNG</b>
                                    <hr>
                                    <img src="{{asset('storage/'.$service->icon_image)}}" alt="{{$service->name}}"
                                        class="img-fluid" style="width: 60px">
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="list-group">
                                    <li class="list-group-item"><b>Code : </b>{{$service->code}}</li>
                                    <li class="list-group-item"><b>Created At :
                                        </b>{{$service->updated_at->toFormattedDateString()}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="text-center"><b>Title</b></h2>
                                <br>
                                <h6 class="text-muted">{{$service->name}}</h6>
                            </div>
                            <div class="col-lg-12 my-2">
                                <h2 class="text-center"><b>Description</b></h2>
                                <br>
                                @isset($service->description)
                                {!! $service->description !!}
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.service.scripts')
@endsection