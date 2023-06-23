@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-card title="All Product">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('product') }}" class="btn btn-primary btn-air-primary">Create Product</a>
        </x-slot>
        <x-slot name="content">
            @livewire('admin.product.product-table')
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.product.scripts')
@endsection
