@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-show-page name="facility" route="facility" :model="$facility">
        <x-slot name="content">
            @if (!is_null($facility->description))
                {!! $facility->description !!}
            @endif
        </x-slot>
        </x-admin.show-page>
    @endsection

    @section('custom_js')
        @include('website::admin.layouts.modules.facility.scripts')
    @endsection
