@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="gallery" route="gallery" :model="$gallery">
    <x-slot name="content">
        <div class="row">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{$gallery->name ?? 'Gallery'}}</h5>
                            <p class="help-block">{{$gallery->excerpt}}.</p>
                            @isset($$gallery->description)
                            <p class="help-block">{!! $gallery->description !!}</p>
                            @endisset
                        </div>
                        <div class="gallery my-gallery card-body row">
                            @if($gallery->images)
                            @foreach ($gallery->images as $image)
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
                                        <button class="pswp__button pswp__button--fs"
                                            title="Toggle fullscreen"></button>
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
                </div>
            </div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.gallery.scripts')
@endsection