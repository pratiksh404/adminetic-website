@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-show-page name="notice" route="notice" :model="$notice">
        <x-slot name="content">
            @if (!is_null($notice->description))
                {!! $notice->description !!}
            @endif
        </x-slot>
        </x-admin.show-page>
    @endsection

    @section('custom_js')
        @include('website::admin.layouts.modules.notice.scripts')
    @endsection
