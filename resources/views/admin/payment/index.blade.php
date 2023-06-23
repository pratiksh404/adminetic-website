@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Payment</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="router" href="http://merologistic.test/admin/dashboard"> <svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg></a>
                    </li>
                    <li class="breadcrumb-item active">Payment</li>
                </ol>
            </div>
        </div>
    </div>

    @livewire('admin.payment.payment-master')
@endsection
