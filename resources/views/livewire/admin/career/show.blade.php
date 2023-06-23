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
                            <b>Short Description :- </b><br>
                            {{ $career->excerpt }}
                            @if (!is_null($career->description))
                                <br>
                                <b>Description :- </b> <br>
                                {!! $career->description !!}
                            @endif
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
