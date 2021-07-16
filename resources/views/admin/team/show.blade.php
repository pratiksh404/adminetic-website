@extends('adminetic::admin.layouts.app')

@section('content')
<x-adminetic-show-page name="team" route="team" :model="$team">
    <x-slot name="content">
        <div class="row">
            <div class="col-lg-4">
                @if (isset($team->image))
                <div class="row">
                    <div class="col-lg-12">
                        <label>Member Image</label>
                        <hr>
                        <img src="{{asset($team->thumbnail('image','medium'))}}" alt="{{$team->name}}"
                            class="img-fluid">
                    </div>
                </div>
                <br>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="list-group">
                            <li class="list-group-item"><b>Name : </b>{{$team->name}}</li>
                            <li class="list-group-item"><b>Phone : </b>
                                @foreach ($team->phone as $phone)
                                {{$phone}},
                                @endforeach
                            </li>
                            <li class="list-group-item"><b>Email : </b><a href="mailto:{{$team->email}}"><i
                                        class="fas fa-envelope-square"></i></a></li>
                            <li class="list-group-item"><b>Facebook : </b><a href="{{$team->facebook}}"><i
                                        class="fab fa-facebook"></i></a>
                            </li>
                            <li class="list-group-item"><b>Instagram : </b><a href="{{$team->instagram}}"><i
                                        class="fab fa-instagram"></i></a>
                            </li>
                            <li class="list-group-item"><b>Twitter : </b><a href="{{$team->twitter}}"><i
                                        class="fab fa-twitter"></i></a>
                            </li>
                            <li class="list-group-item"><b>Linkedin : </b><a href="{{$team->linkedin}}"><i
                                        class="fab fa-linkedin"></i></a>
                            </li>
                            <li class="list-group-item"><b>Github : </b><a href="{{$team->github}}"><i
                                        class="fab fa-github"></i></a>
                            </li>
                            <li class="list-group-item"><b>Messenger : </b><a href="{{$team->messenger}}"><i
                                        class="fab fa-facebook-messenger"></i></a>
                            </li>
                            <li class="list-group-item"><b>Whatsapp : </b><a href="{{$team->whatsapp}}"><i
                                        class="fab fa-whatsapp"></i></a>
                            </li>
                            <li class="list-group-item"><b>Priority : </b>{{$team->priority}}</li>
                            <li class="list-group-item"><b>Code : </b>{{$team->code}}</li>
                            <li class="list-group-item"><b>Created At :
                                </b>{{$team->updated_at->toFormattedDateString()}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12">
                        <label>
                            <h2><b>Message</b></h2>
                        </label>
                        <br>
                        @isset($team->message)
                        {!! $team->message !!}
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-adminetic-show-page>

@endsection

@section('custom_js')
@include('website::admin.layouts.modules.team.scripts')
@endsection