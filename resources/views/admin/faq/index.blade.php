@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All FAQs</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">FAQs</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="faq" route="faq">
    <x-slot name="buttons">
        <a href="{{ adminCreateRoute('faq') }}" class="btn btn-primary btn-air-primary mx-1">Create
            FAQ</a>
    </x-slot>
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered faq_datatable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Position</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faqs as $faq)
                <tr>
                    <td>{{$faq->id}}</td>
                    <td>{{$faq->position}}</td>
                    <td>{{$faq->created_at->toDateTimeString()}}</td>
                    <td>
                        <x-adminetic-action :model="$faq" route="faq" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-card>
@endsection

@section('custom_js')
@include('website::admin.layouts.modules.faq.scripts')
@endsection