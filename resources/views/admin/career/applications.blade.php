@extends(request()->header('layout') ?? 'adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-show-page name="career" route="career" :model="$career">
        <x-slot name="content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body shadow-lg">
                            <ul class="list-group">
                                <li class="list-group-item"><b>Title : </b> <span
                                        class="text-muted">{{ $career->title ?? '-' }}</span>
                                </li>
                                <li class="list-group-item"><b>Designation : </b> <span
                                        class="text-muted">{{ $career->designation ?? '-' }}</span></li>
                                <li class="list-group-item"><b>Location : </b> <span
                                        class="text-muted">{{ $career->location ?? '-' }}</span>
                                </li>
                                <li class="list-group-item"><b>Salary : </b> <span
                                        class="text-muted">{{ $career->salary ?? '-' }}</span>
                                </li>
                                <li class="list-group-item"><b>Deadline : </b> <span
                                        class="text-muted">{{ $career->deadline ?? '-' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if (!is_null($career->summary))
                        <div class="card">
                            <div class="card-body shadow-lg p-2">
                                <div class="card-header">
                                    <h4 class="card-title">Summary</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach ($career->summary as $summary)
                                            @if (isset($summary['subject']))
                                                <li class="list-group-item"><b>{{ $summary['subject'] ?? 'N/A' }}</b> <span
                                                        class="text-muted">{{ $summary['information'] ?? 'N/A' }}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body shadow-lg p-2">
                            <div class="row">
                                <div class="col-4">Candidate</div>
                                <div class="col-4">Short Listed</div>
                                <div class="col-4">Selected</div>
                            </div>
                            <br>
                            @foreach ($career->applications as $application)
                                <div class="row">
                                    <div class="col-4">
                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                            data-bs-target=".application{{ $application->id }}">{{ $application->name }}</button>
                                        <div class="modal fade application{{ $application->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myLargeModalLabel">
                                                            {{ $application->name }}</h4>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
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
                                                                    <b>File : </b> <span class="text-muted"><a
                                                                            href="{{ asset('storage/' . $application->file) }}"
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
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        @livewire('admin.career.selection', ['application' => $application], key($application->id))
                                    </div>
                                </div>
                                <br>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-adminetic-show-page>

@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.career.scripts')
@endsection
