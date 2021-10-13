@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="project" route="project" :model="$project">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body p-3">
                        @isset($project->image)
                        <img src="{{asset('storage/' . $project->image)}}" alt="$project->name" class="img-fluid">
                        @endisset
                        <ul class="list-group">
                            <li class="list-group-item">
                                <b>name :</b><span class="text-muted">{{$project->name ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>slug :</b><span class="text-muted">{{$project->slug ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>client :</b><span class="text-muted">{{$project->client ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>duration :</b><span class="text-muted">{{$project->duration ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>category :</b><span class="text-muted">{{$project->category ?? 'N/A'}}</span>
                            </li>
                            @isset($project->link)
                            <li class="list-group-item">
                                <b>link :</b><a href="{{$project->link}}">Click Me !</a>
                            </li>
                            @endisset
                            <li class="list-group-item">
                                <b>position :</b><span class="text-muted">{{$project->position ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>meta name :</b><span class="text-muted">{{$project->meta_name ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>meta_description :</b><span class="text-muted">{{$project->meta_description ??
                                    'N/A'}}</span>
                            </li>
                            @isset($project->meta_keywords)
                            <li class="list-group-item">
                                <b>Keywords </b>
                                <hr>
                                @foreach ($project->meta_keywords as $meta_keyword)
                                <span class="badge badge-primary">{{$meta_keyword}}</span>
                                @endforeach
                            </li>
                            @endisset
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-body p-3">
                        <h4 class="text-center">Description</h4>
                        <hr>
                        {!! $project->description !!}
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.project.scripts')
@endsection