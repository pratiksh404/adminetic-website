<div class="card shadow-lg">
    @if ($event->featured)
    <div class="ribbon ribbon-bookmark ribbon-vertical-right ribbon-secondary"><i class="far fa-star"></i></div>
    @endif
    <div class="product-box">
        <div class="product-img"><img class="img-fluid" src="{{$event->image}}" alt="{{$event->name}}">
            <div class="product-hover">
                <ul class="text-center">
                    @if (auth()->user()->can('update', $event))
                    <li class="m-2">
                        <a href="{{ adminEditRoute('event', $event->id) }}" class="router btn" title="Edit"
                            data-toggle="tooltip" placement="top"><i class="fa fa-edit"></i></a>
                    </li>
                    <li class="m-2">
                        <a href="{{route('event.ticket_planning',['event' => $event->id])}}" title="Ticket Planning"
                            class="btn router">
                            <i class="fa fa-ticket-alt"></i>
                        </a>
                    </li>
                    <li class="m-2">
                        <a href="{{route('event.claim_card',['event' => $event->id])}}" title="Pass Card"
                            class="btn router">
                            <i class="fa fa-print"></i>
                        </a>
                    </li>
                    <li class="m-2">
                        <a href="{{route('event.questionnaire',['event' => $event->id])}}" title="Event Questionnaire"
                            class="btn router">
                            <i class="fa fa-question"></i>
                        </a>
                    </li>
                    <li class="m-2">
                        <a href="{{route('event.images',['event' => $event->id])}}" class="btn router"
                            title="Event Images">
                            <i class="fa fa-image"></i>
                        </a>
                    </li>
                    <li class="m-2">
                        <a href="{{route('event.passes',['event' => $event->id])}}" class="btn router"
                            title="Event Passes">
                            <i class="fab fa-gg"></i>
                        </a>
                    </li>
                    <li class="m-2">
                        <a href="{{route('event.faqs',['event' => $event->id])}}" class="btn router" title="Event FAQs">
                            <i class="fa fa-fist-raised"></i>
                        </a>
                    </li>
                    <li class="m-2">
                        <a href="{{route('event.testimonials',['event' => $event->id])}}" class="btn router"
                            title="Event Testimonials">
                            <i class="far fa-newspaper"></i>
                        </a>
                    </li>
                    <li class="m-2">
                        <a href="{{route('event.counters',['event' => $event->id])}}" class="btn router"
                            title="Event Counters">
                            <i class="fa fa-trophy"></i>
                        </a>
                    </li>
                    <li class="m-2">
                        <button class="btn" type="button" wire:click="featureEvent({{$event->id}})"><i
                                class="far fa-star"></i></button>
                    </li>
                    <li class="m-2">
                        <a href="{{route('event.website',['event' => $event->id])}}" class="btn router"
                            title="Event Website Content">
                            <i class="fab fa-chrome"></i>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->can('view', $event))
                    <li class="m-2">
                        <a href="{{ adminShowRoute('event', $event->id) }}" class="router btn" title="Edit"
                            data-toggle="tooltip" placement="top"><i class="fa fa-eye"></i></a>
                    </li>
                    @endif
                    @if (auth()->user()->can('delete', $event))
                    <li class="m-2">
                        <button class="btn" type="button" data-bs-toggle="modal" data-original-title="Delete"
                            data-bs-target="#delete-{{ $event->id }}"><i class="fa fa-trash"></i></button>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        {{-- Delete Modal --}}
        <!-- Modal -->
        <div class="modal fade" id="delete-{{ $event->id }}" tabindex="-1" role="dialog"
            aria-labelledby="delete-{{ $event->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Item !</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="admin-form" action="{{ adminDeleteRoute('event', $event->id) }}" method="POST"
                        serverMethod="DELETE">
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            Are you sure you want to delete this item.
                            <br>

                        </div>
                        <div class="modal-footer">
                            <button class="close btn grey btn-danger btn-air-danger" type="button"
                                data-bs-dismiss="modal" aria-label="Close">Close
                            </button>

                            <button type="submit" class="btn btn-danger btn-air-danger">Yes
                                Delete It !</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="product-details text-center">
            <h4>{{$event->name}}</h4>
            <p>{{$event->excerpt}}</p>
        </div>
    </div>
</div>