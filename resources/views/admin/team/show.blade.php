@extends(request()->header('layout') ?? (request()->header('layout') ?? 'adminetic::admin.layouts.app'))

@section('content')
    <x-adminetic-show-page name="team" route="team" :model="$team">
        <x-slot name="content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body shadow-lg p-3">
                            @if ($team->getFirstMediaUrl('image'))
                                <img src="{{ $team->getFirstMediaUrl('image') }}" alt="{{ $team->name }}" class="img-fluid">
                                <hr>
                            @endif
                            @include('website::admin.layouts.modules.team.social_media', ['team' => $team])
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            Short Message
                        </div>
                        <div class="card-body shadow-lg p-3">
                            {{ $team->short_message }}
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Description
                        </div>
                        <div class="card-body shadow-lg p-3">
                            @isset($team->description)
                                {!! $team->description !!}
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        </x-admin.show-page>
    @endsection

    @section('custom_js')
        @include('website::admin.layouts.modules.team.scripts')
    @endsection
