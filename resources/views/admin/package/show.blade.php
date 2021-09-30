@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="package" route="package" :model="$package">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card show-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="list-group">
                                    <li class="list-group-item"><b>Name : </b>{{$package->name}}</li>
                                    <li class="list-group-item"><b>Plan :
                                        </b>{{$package->package_time}}</li>
                                    <li class="list-group-item"><b>Price :
                                        </b>{{config('adminetic.currency_symbol','Rs.')}}{{$package->package_cost}}</li>
                                    <li class="list-group-item" style="background-color: {{$package->color}}">
                                        <span style="color: white">Color</span>
                                    </li>
                                    <li class="list-group-item"><span
                                            class=" badge badge-{{$package->active ? "success" : "danger"}}">
                                            {{$package->active ? "Active" : "Inactive"}}</span>
                                    </li>
                                    @isset($package->link)
                                    <a href="{{$package->link}}" class="btn btn-primary">Link</a>
                                    @endisset
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label>
                                    <h2><b>Features</b></h2>
                                </label>
                                <br>
                                <ul class="list-group">
                                    @isset($package->features)
                                    @foreach ($package->features as $feature)
                                    <li class="list-group-item">{{$feature}}</li>
                                    @endforeach
                                    @endisset
                                </ul>
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
@include('website::admin.layouts.modules.package.scripts')
@endsection