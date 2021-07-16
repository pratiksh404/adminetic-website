@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="project" route="project" :model="$project">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="list-group">
                                    @if (isset($project->image))
                                    <img src="{{asset($project->thumbnail('image','medium'))}}" alt="{{$project->name}}"
                                        class="img-fluid">
                                    @else
                                    <img src="{{getImagePlaceholder()}}" alt="{{$project->name}}" class="img-fluid">
                                    @endif
                                    <li class="list-group-item"><b>Client : </b>{{$project->client->name}}
                                        <hr>
                                        @isset($project->client->image)
                                        <img src="{{asset('storage/'.$project->client->image)}}"
                                            alt="{{$project->client->name}}" class="img-fluid">
                                        @endisset
                                    </li>
                                    <li class="list-group-item"><b>Duration :
                                        </b>{{$project->duration}}</li>
                                    <li class="list-group-item"><b>Category :
                                        </b>{{$project->category}}</li>
                                    @isset($project->link)
                                    <a href="{{$project->link}}" class="btn btn-primary">Link</a>
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
                                    <h2><b>Description</b></h2>
                                </label>
                                <br>
                                <p>
                                    @isset($project->description)
                                    {!! $project->description !!}
                                    @endisset
                                </p>
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
@include('website::admin.layouts.modules.project.scripts')
@endsection