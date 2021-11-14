@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="popup" route="popup" :model="$popup">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body p-3">
                        <ul class="list-group">
                            <li class="list-group-item"><b>code :</b><span class="text-muted">{{$popup->code ??
                                    'N/A'}}</span></li>
                            <li class="list-group-item"><b>name :</b><span class="text-muted">{{$popup->name ??
                                    'N/A'}}</span></li>
                            <li class="list-group-item"><b>url :</b><span class="text-muted">{{$popup->url ??
                                    'N/A'}}</span></li>
                            <li class="list-group-item"><b>position :</b><span class="text-muted">{{$popup->position ??
                                    'N/A'}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-body p-3">
                        @isset($popup->image)
                        <span class="text-center">Image</span>
                        <hr>
                        <img src="{{asset('storage/' . $popup->image)}}" alt="{{$popup->name ?? ''}}" class="img-fluid">
                        @endisset
                        @isset($popup->body)
                        <span class="text-center">Body</span>
                        <hr>
                        {!! $popup->body !!}
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.popup.scripts')
@endsection