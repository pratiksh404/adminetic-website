@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Post">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('post') }}" class="btn btn-primary btn-air-primary">Create Post</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.post.post-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.post.scripts')
@endsection
