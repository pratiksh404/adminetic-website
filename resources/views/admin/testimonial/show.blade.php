@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="testimonial" route="testimonial" :model="$testimonial">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                @isset($testimonial->image)
                <img src="{{asset('storage/' . $testimonial->image)}}" class="img-fluid">
                @endisset
                <ul class="list-group">
                    <li class="list-group-item">
                        <b>code : </b><span class="text-muted">{{$testimonial->code ?? 'N/A'}}</span>
                    </li>
                    <li class="list-group-item">
                        <b>name : </b><span class="text-muted">{{$testimonial->name ?? 'N/A'}}</span>
                    </li>
                    <li class="list-group-item">
                        <b>email : </b><span class="text-muted">{{$testimonial->email ?? 'N/A'}}</span>
                    </li>
                    <li class="list-group-item">
                        <b>contact : </b><span class="text-muted">{{$testimonial->contact ?? 'N/A'}}</span>
                    </li>
                    <li class="list-group-item">
                        <b>designation : </b><span class="text-muted">{{$testimonial->designation ??
                            'N/A'}}</span>
                    </li>
                    <li class="list-group-item">
                        <b>company : </b><span class="text-muted">{{$testimonial->company ?? 'N/A'}}</span>
                    </li>
                    <li class="list-group-item">
                        <b>rating : </b><span class="text-muted">{{$testimonial->rating ?? 'N/A'}}</span>
                    </li>
                    <li class="list-group-item">
                        <b>position : </b><span class="text-muted">{{$testimonial->position ??
                            'N/A'}}</span>
                    </li>
                    <li class="list-group-item">
                        <span
                            class="badge badge-{{$testimonial->approve ? 'success' : 'danger'}}">{{$testimonial->approve
                            ? 'Approved' : 'Denied'}}</span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-8">
                <h4 class="text-center">Testimonial</h4>
                <hr>
                {!! $testimonial->body !!}
            </div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.testimonial.scripts')
@endsection