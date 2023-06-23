@extends(request()->header('layout') ?? 'adminetic::admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Visitor Message</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Visitor Message</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <x-adminetic-card title="All Visitor Message">
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
                        <th>Subject</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                        <tr>
                            <td>{{ toBS($message->updated_at) }}</td>
                            <td>{{ $message->name ?? 'N/A' }}</td>
                            <td>{{ $message->email ?? 'N/A' }}</td>
                            <td>{{ $message->phone ?? 'N/A' }}</td>
                            <td>{{ $message->company ?? 'N/A' }}</td>
                            <td>{{ $message->subject ?? 'N/A' }}</td>
                            <td>
                                <button class="btn btn-primary btn-air-primary" type="button" data-bs-toggle="modal"
                                    data-original-title="message" data-bs-target="#message{{ $message->id }}"><i
                                        class="fa fa-comment"></i></button>
                                <div class="modal fade" id="message{{ $message->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="message{{ $message->id }}ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Visitor's Message</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{ $message->message ?? 'N/A' }}
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
