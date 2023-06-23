@extends(request()->header('layout') ?? 'adminetic::admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Application Detail</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Application Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body shadow-lg p-3">
            <div>
                <div class="row">
                    <div class="col-lg-6">
                        <b>Name : </b> <span
                            class="text-muted">{{ $application->name ?? 'N/A' }}</span>
                    </div>
                    <div class="col-lg-6">
                        <b>Email : </b> <span
                            class="text-muted">{{ $application->email ?? 'N/A' }}</span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-6">
                        <b>Phone : </b> <span
                            class="text-muted">{{ $application->phone_no ?? 'N/A' }}</span>
                    </div>
                    @if (!is_null($application->file))
                        <div class="col-lg-6">
                            <b>File : </b> <span class="text-muted"><a href="{{ asset('storage/' . $application->file) }}"
                                    download>Download</a></span>
                        </div>
                    @endif
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <b>Message :-</b>
                        <br>
                        {{ $application->message }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
