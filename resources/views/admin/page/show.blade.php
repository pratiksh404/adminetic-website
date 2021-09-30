@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="page" route="page" :model="$page">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body p-3">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <b>Code :</b> <span class="text-muted"> {{$page->code ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Name :</b> <span class="text-muted"> {{$page->name ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Slug :</b> <span class="text-muted"> {{$page->slug ?? 'N/A'}}</span>
                            </li>
                            @isset($page->image)
                            <li class="list-group-item">
                                <b>Page Image :</b>
                                <hr>
                                <img src="{{asset('storage/' . $page->image)}}" alt="{{$page->name}}" class="img-fluid">
                            </li>
                            @endisset
                            <li class="list-group-item">
                                <b>Type :</b> <span class="badge badge-primary">{{$page->type}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Active :</b> <span
                                    class="badge badge-{{$page->active ? 'success' : 'danger'}}">{{$page->active ? 'Yes' : 'No'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Position :</b> <span class="text-muted"> {{$page->position ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b> Meta Name:</b> <span class="text-muted"> {{$page->meta_name ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Meta Description :</b> <span class="text-muted">
                                    {{$page->meta_description ?? 'N/A'}}</span>
                            </li>
                            @isset($page->meta_keywords)
                            <li class="list-group-item">
                                <b>Meta Keywords :</b>
                                <hr>
                                @foreach ($page->meta_keywords as $keyword)
                                <span class="badge badge-primary">{{$keyword}}</span>
                                @endforeach
                            </li>
                            @endisset
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                @if(!is_null($page->video_embed))
                <div class="card shadow-lg">
                    <div class="card-body p-3">
                        <b>Video</b>
                        <hr>
                        <div class="embed-responsive embed-responsive-16by9">
                            {!! $page->video_embed !!}
                        </div>
                    </div>
                </div>
                @endif
                @isset($page->body)
                <div class="card shadow-lg">
                    <div class="card-body p-3">
                        <b>Body</b>
                        <hr>
                        {!! $page->body !!}
                    </div>
                </div>
                @endisset
            </div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.page.scripts')
@endsection