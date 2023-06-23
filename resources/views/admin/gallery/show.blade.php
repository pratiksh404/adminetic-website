@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-show-page name="gallery" route="gallery" :model="$gallery">
        <x-slot name="content">
            @livewire('admin.system.model-gallery', ['model' => $gallery, 'attribute' => 'images', 'multiple' => true])
            <br>
            @livewire('admin.gallery.gallery-video', ['gallery' => $gallery ?? null])
        </x-slot>
        </x-admin.show-page>
    @endsection

    @section('custom_js')
        @include('website::admin.layouts.modules.gallery.scripts')
    @endsection
