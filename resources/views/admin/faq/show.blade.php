@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="faq" route="faq" :model="$faq">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">Question</h4>
                    </div>
                    <div class="card-body">
                        @isset($faq->question)
                        {!! $faq->question !!}
                        @endisset
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title">Answer</h4>
                    </div>
                    <div class="card-body">
                        @isset($faq->answer)
                        {!! $faq->answer !!}
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.faq.scripts')
@endsection