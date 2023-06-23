@extends(request()->header('layout') ?? 'adminetic::admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Visitor inquiry</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Visitor inquiry</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <x-adminetic-card title="All Visitor inquiry">
        <x-slot name="content">
            {{-- ================================Card================================ --}}
            <table class="table table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company</th>
                        <th>Product/Software</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inquiries as $inquiry)
                        <tr>
                            <td>{{ toBS($inquiry->updated_at) }}</td>
                            <td>{{ $inquiry->name ?? 'N/A' }}</td>
                            <td>{{ $inquiry->email ?? 'N/A' }}</td>
                            <td>{{ $inquiry->phone ?? 'N/A' }}</td>
                            <td>{{ $inquiry->company ?? 'N/A' }}</td>
                            <td>{{ $inquiry->software->name ?? ($inquiry->service->name ?? ($inquiry->product->name ?? '-')) }}
                            </td>
                            <td>
                                <button class="btn btn-primary btn-air-primary" type="button" data-bs-toggle="modal"
                                    data-original-title="inquiry" data-bs-target="#inquiry{{ $inquiry->id }}"><i
                                        class="fa fa-comment"></i></button>
                                <div class="modal fade" id="inquiry{{ $inquiry->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="inquiry{{ $inquiry->id }}ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Visitor's inquiry</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{ $inquiry->message ?? 'N/A' }}
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" type="button"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company</th>
                        <th>Subject</th>
                        <th>Message</th>
                    </tr>
                </tfoot>
            </table>
            {{-- =================================================================== --}}
        </x-slot>
    </x-adminetic-card>
@endsection
