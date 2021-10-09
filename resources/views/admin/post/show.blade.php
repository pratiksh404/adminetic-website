@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="post" route="post" :model="$post">
    <x-slot name="content">
        <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="info-home-tab" data-bs-toggle="tab" href="#info-home"
                    role="tab" aria-controls="info-home" aria-selected="true">Statistics</a></li>
            <li class="nav-item"><a class="nav-link" id="profile-info-tab" data-bs-toggle="tab" href="#info-profile"
                    role="tab" aria-controls="info-profile" aria-selected="false">Description</a></li>
        </ul>
        <div class="tab-content" id="info-tabContent">
            <div class="tab-pane fade show active" id="info-home" role="tabpanel" aria-labelledby="info-home-tab">
                @include('website::admin.layouts.modules.post.statistics')
            </div>
            <div class="tab-pane fade" id="info-profile" role="tabpanel" aria-labelledby="profile-info-tab">
                @include('website::admin.layouts.modules.post.description')
            </div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.post.scripts')
@endsection