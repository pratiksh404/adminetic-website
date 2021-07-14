@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="counter" route="counter">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($counters as $counter)
                <tr>
                    <td>
                        @if ($counter->icon)
                        <img src="{{asset('storage/'.$counter->icon)}}" alt="{{$counter->name}}" class="img-fluid"
                            height="40" width="40">
                        @else
                        <img src="{{getImagePlaceholder()}}" alt="{{$counter->name}}" class="img-fluid" height="40"
                            width="40">
                        @endif
                    </td>
                    <td>{{$counter->name}}</td>
                    <td>{{$counter->value}}</td>
                    <td>
                        <x-adminetic-action :model="$counter" route="counter" show=0 />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Count</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.counter.scripts')
@endsection