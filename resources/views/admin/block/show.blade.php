@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="block" route="block" :model="$block">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-lg">
                    <div class="card-body p-3">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <b>Code :</b><span class="text-muted">{{$block->code ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Name :</b><span class="text-muted">{{$block->name ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Page :</b><span class="text-muted">{{$block->page ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Version :</b><span class="text-muted">{{$block->version ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Location :</b><span class="text-muted">{{$block->location ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Position :</b><span class="text-muted">{{$block->position ?? 'N/A'}}</span>
                            </li>
                            <li class="list-group-item">
                                <span class="badge badge-{{$block->active ? 'success' : 'danger'}}">{{$block->active ?
                                    'Active' : 'Inactive'}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-lg-12">
                                @if (isset($block->image))
                                <img src="{{asset('storage/' . $block->image)}}" alt="{{$block->name}}"
                                    class="img-fluid">
                                <hr>
                                @endif
                                @isset($block->body)
                                {!! $block->body !!}
                                @endisset
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
@include('website::admin.layouts.modules.block.scripts')
@endsection