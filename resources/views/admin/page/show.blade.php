@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="page" route="page" :model="$page">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow-lg">
                            <div class="card-content ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <b>Page Title</b> <br>
                                            <h4>{{$page->title}}</h4>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <b>Page Slug</b> <br>
                                            <h4>{{$page->slug}}</h4>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <b>Page Excerpt</b>
                                            <br>
                                            <p class="text-muted">
                                                {{$page->excerpt}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12" style="overflow-x: auto">
                                        @if($page->body)
                                        {!! $page->body !!}
                                        @else
                                        <div class="d-flex justify-content-center">
                                            <h2 class="text-muted">This page body is empty.</h2>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4" style="height:80vh;overflow-y:auto">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow-lg">
                            <div class="card-content ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <b>Code : </b>
                                            <h6 class="text-muted">{{$page->code}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow-lg">
                            <div class="card-content ">
                                <div class="d-flex justify-content-center">
                                    @if ($page->image)
                                    <img src="{{asset($page->thumbnail('image','small'))}}" alt="{{$page->title}}"
                                        class="img-fluid">
                                    @else
                                    <img src="{{getImagePlaceholder()}}" alt="{{$page->title}}" class="img-fluid">
                                    @endif
                                </div>
                                @if (isset($page->video))
                                <hr>
                                <div class="d-flex justify-content-center">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="{{$page->video}}"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow-lg">
                            <div class="card-content ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <b>Status : </b> <span
                                                class="p-1 badge badge-{{$page->status == "Pending" ? "warning" : ($page->status == "Draft" ? "info" : "success")}}">{{$page->status}}</span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <b>Featured : </b>
                                            <h6 class="text-muted">{{$page->featured}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow-lg">
                            <div class="card-header">
                                <h4 class="card-title">Tags</h4>
                            </div>
                            <div class="card-content ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @isset($tags)
                                            @foreach ($tags as $tag)
                                            <span class="badge badge-success">{{$tag}}</span>
                                            @endforeach
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow-lg">
                            <div class="card-header">
                                <h4 class="card-title">SEO</h4>
                            </div>
                            <div class="card-content ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <b>Ttile : </b>
                                            <h6 class="test-muted">{{$page->seo_title}}</h6>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <b>Meta Description</b>
                                            <hr>
                                            <p>
                                                {{$page->meta_description}}
                                            </p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <b>Meta Keywords</b>
                                            <hr>
                                            @isset($page->meta_keywords)
                                            @foreach ($page->meta_keywords as $keyword)
                                            <span class="badge badge-info">{{$keyword}}</span>
                                            @endforeach
                                            @endisset
                                        </div>
                                    </div>
                                </div>
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
@include('website::admin.layouts.modules.page.scripts')
@endsection