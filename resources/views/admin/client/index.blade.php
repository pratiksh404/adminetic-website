@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-index-page name="client" route="client">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr>
                    <td>
                        @if ($client->image)
                        <img src="{{asset('storage/'.$client->image)}}" alt="{{$client->name}}"
                            style="width:64px;height:auto;" class="img-fluid">
                        @else
                        <img src="{{getImagePlaceholder()}}" alt="{{$client->name}}" class="img-fluid"
                            class="img-fluid">
                        @endif
                    </td>
                    <td><a href="{{$client->url ?? "#"}}">{{$client->name}}</a></td>
                    <td>
                        <x-adminetic-action :model="$client" route="client" show="0" />
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-index-page>
@endsection

@section('custom_js')
@include('admin.layouts.modules.client.scripts')
@endsection