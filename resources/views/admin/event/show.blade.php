@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="event" route="event" :model="$event">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <b>Code :</b> <span class="text-muted">{{$event->code ?? 'N/A'}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Name :</b> <span class="text-muted">{{$event->name ?? 'N/A'}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Slug :</b> <span class="text-muted">{{$event->slug ?? 'N/A'}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Event Date :</b> <span
                                            class="text-muted">{{$event->single_date ? $event->event_date->toFormattedDateString() : $event->interval}}</span>
                                    </li>
                                    @isset($event->notice)
                                    <li class="list-group-item">
                                        <b>Notice :</b> <span class="text-muted"><br>
                                            {{$event->notice ?? 'N/A'}}</span>
                                    </li>
                                    @endisset
                                    <li class="list-group-item">
                                        <b>Meta Name :</b> <span
                                            class="text-muted">{{$event->meta_name ?? 'N/A'}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Meta Description :</b> <span
                                            class="text-muted">{{$event->meta_description ?? 'N/A'}}</span>
                                    </li>
                                    @isset($event->meta_keywords)
                                    <li class="list-group-item">
                                        <b>Keywords :</b>
                                        @foreach ($event->meta_keywords as $meta_keyword)
                                        <span class="badge badge-primary">{{$meta_keyword}}</span>
                                        @endforeach
                                    </li>
                                    @endisset
                                </ul>
                            </div>
                        </div>
                        @isset($event->image)
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <img src="{{asset($event->thumbnail('image','small'))}}" alt="{{$event->name}}"
                                    class="img-fluid">
                            </div>
                        </div>
                        @endisset
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                @isset($event->gallery_id)
                @if ($event->gallery->images->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h5><b>Gallery : </b>{{$event->gallery->name ?? 'N/A'}}</h5>
                        @isset($$event->gallery->excerpt)
                        {!! $event->gallery->excerpt !!}
                        @endisset
                        @isset($$event->gallery->description)
                        <p class="help-block">{!! $event->gallery->description !!}</p>
                        @endisset
                    </div>
                    <div class="gallery my-gallery card-body row">
                        @if($event->gallery->images)
                        @foreach ($event->gallery->images as $image)
                        <figure class="col-xl-3 col-md-4 col-6" itemprop="associatedMedia" itemscope=""><a
                                href="{{asset('storage/' . $image->image)}}" itemprop="contentUrl"
                                data-size="1600x950"><img class="img-thumbnail"
                                    src="{{asset('storage/' . $image->image)}}"
                                    itemprop="{{$image->title ?? 'gallery Image'}}" alt="Image description"></a>
                            @isset($image->excerpt)
                            {{$image->excerpt}}
                            @endisset
                        </figure>
                        @endforeach
                        @else
                        <div class="col-lg-12">
                            <span class="text-muted text-center">Gallery has no images.</span>
                        </div>
                        @endif
                    </div>
                    <!-- Root element of PhotoSwipe. Must have class pswp.-->
                    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="pswp__bg"></div>
                        <div class="pswp__scroll-wrap">
                            <div class="pswp__container">
                                <div class="pswp__item"></div>
                                <div class="pswp__item"></div>
                                <div class="pswp__item"></div>
                            </div>
                            <div class="pswp__ui pswp__ui--hidden">
                                <div class="pswp__top-bar">
                                    <div class="pswp__counter"></div>
                                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                                    <button class="pswp__button pswp__button--share" title="Share"></button>
                                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                                    <div class="pswp__preloader">
                                        <div class="pswp__preloader__icn">
                                            <div class="pswp__preloader__cut">
                                                <div class="pswp__preloader__donut"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                    <div class="pswp__share-tooltip"></div>
                                </div>
                                <button class="pswp__button pswp__button--arrow--left"
                                    title="Previous (arrow left)"></button>
                                <button class="pswp__button pswp__button--arrow--right"
                                    title="Next (arrow right)"></button>
                                <div class="pswp__caption">
                                    <div class="pswp__caption__center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endisset
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h6 class="card-title">Description</h6>
                    </div>
                    <div class="card-body p-3">
                        {!! $event->description !!}
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.event.scripts')
@endsection