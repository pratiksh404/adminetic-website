@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-show-page name="post" route="post" :model="$post">
        <x-slot name="content">
            @if (!is_null($post->description))
                {!! $post->description !!}
            @endif
        </x-slot>
        </x-admin.show-page>
    @endsection

    @section('custom_js')
        @include('website::admin.layouts.modules.post.scripts')
    @endsection
