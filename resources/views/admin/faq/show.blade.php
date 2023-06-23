@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-show-page name="faq" route="faq" :model="$faq">
        <x-slot name="content">
            <div class="card">
                <div class="card-header">
                    {!! $faq->question !!}
                </div>
                <div class="card-body shadow-lg p-3">
                    {!! $faq->answer !!}
                </div>
            </div>
        </x-slot>
        </x-admin.show-page>
    @endsection

    @section('custom_js')
        @include('website::admin.layouts.modules.faq.scripts')
    @endsection
