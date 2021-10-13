@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Testimonials</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Testimonials</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="testimonial" route="testimonial">
    <x-slot name="buttons">
        <a href="{{adminCreateRoute('testimonial')}}" class="btn btn-primary btn-air-primary">Create Testimonial</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="info-list-tab" data-bs-toggle="tab" href="#info-list"
                    role="tab" aria-controls="info-list" aria-selected="true">List</a></li>
            <li class="nav-item"><a class="nav-link" id="reorder-info-tab" data-bs-toggle="tab" href="#info-reorder"
                    role="tab" aria-controls="info-reorder" aria-selected="false">Reorder Testimonial</a></li>
        </ul>
        <div class="tab-content" id="info-tabContent">
            <div class="tab-pane fade show active" id="info-list" role="tabpanel" aria-labelledby="info-list-tab">
                <table class="table table-striped table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Designation</th>
                            <th>Company</th>
                            <th>Approved</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testimonials as $testimonial)
                        <tr>
                            <td>
                                @if (isset($testimonial->image))
                                <img src="{{asset('storage/' . $testimonial->image)}}" alt="{{$testimonial->name}}"
                                    class="img-fluid" width="80">
                                @else
                                <img src="{{getImagePlaceholder()}}" alt="{{$testimonial->name}}" class="img-fluid"
                                    width="80">
                                @endif
                            </td>
                            <td>{{$testimonial->name ?? 'N/A'}}</td>
                            <td>{{$testimonial->contact ?? 'N/A'}}</td>
                            <td>{{$testimonial->email ?? 'N/A'}}</td>
                            <td>{{$testimonial->designation ?? 'N/A'}}</td>
                            <td>{{$testimonial->company ?? 'N/A'}}</td>
                            <td>
                                <span
                                    class="badge badge-{{$testimonial->approve ? 'success' : 'danger'}}">{{$testimonial->approve
                                    ? 'Approved' : 'Denied'}}</span>
                            </td>
                            <td>
                                <x-adminetic-action :model="$testimonial" route="testimonial" />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Designation</th>
                            <th>Company</th>
                            <th>Approved</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="tab-pane fade" id="info-reorder" role="tabpanel" aria-labelledby="reorder-info-tab">
                @livewire('admin.testimonial.reorder-testimonial')
            </div>
        </div>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.testimonial.scripts')
@endsection