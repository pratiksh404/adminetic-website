<div>
    <div class="card profile-box">
        <div class="card-body">
            <div class="media">
                <div class="media-body">
                    <div class="greeting-user">
                        <h4 class="f-w-600">Hello {{ auth()->user()->name }}</h4>
                        <p>Todays news headline</p>
                        <br>
                        <div class="news-headline">
                            @if (isset($headline_news))
                                @if ($headline_news->count() > 0)
                                    @foreach ($headline_news as $news)
                                        <div class="d-flex h-100">
                                            <a href="{{ route('show_notification', ['id' => $news->id]) }}"
                                                style="text-decoration: none">
                                                <p class="text-light">
                                                    {!! $news->data['subject'] ?? '' !!}
                                                </p>
                                                <i class="icon-arrow-top-right f-light"></i>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex h-100">
                                        <h6 class="mb-0 f-w-400"><span class="text-light">No news today </span></h6>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <br>
                        <div class="whatsnew-btn">
                            <div class="btn btn-outline-white" type="button" data-bs-toggle="modal"
                                data-bs-target="#my-notification">
                                My Notification
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="clockbox">
                        <svg id="clock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600">
                            <g id="face">
                                <circle class="circle" cx="300" cy="300" r="253.9"></circle>
                                <path class="hour-marks"
                                    d="M300.5 94V61M506 300.5h32M300.5 506v33M94 300.5H60M411.3 107.8l7.9-13.8M493 190.2l13-7.4M492.1 411.4l16.5 9.5M411 492.3l8.9 15.3M189 492.3l-9.2 15.9M107.7 411L93 419.5M107.5 189.3l-17.1-9.9M188.1 108.2l-9-15.6">
                                </path>
                                <circle class="mid-circle" cx="300" cy="300" r="16.2"></circle>
                            </g>
                            <g id="hour" style="transform: rotate(473.775deg);">
                                <path class="hour-hand" d="M300.5 298V142"></path>
                                <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                            </g>
                            <g id="minute" style="transform: rotate(285.8deg);">
                                <path class="minute-hand" d="M300.5 298V67"></path>
                                <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                            </g>
                            <g id="second" style="transform: rotate(228deg);">
                                <path class="second-hand" d="M300.5 350V55"></path>
                                <circle class="sizing-box" cx="300" cy="300" r="253.9"> </circle>
                            </g>
                        </svg>
                    </div>
                    <div class="badge f-10 p-0" style="position: relative;left: 12px;" id="time">
                    </div>
                </div>
            </div>
            <div class="cartoon"><img class="img-fluid"
                    src="{{ asset('adminetic/assets/images/dashboard/cartoon.svg') }}" alt="vector women with leptop">
            </div>
        </div>
    </div>

    <div class="modal fade" id="my-notification" tabindex="-1" aria-labelledby="myNotificationLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="myNotificationLabel">My Notification</h1>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                        data-bs-original-title="" title=""></button>
                </div>
                <div class="modal-body dark-modal">
                    @livewire('notify.my-notification')
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @push('livewire_third_party')
        <script>
            $(function() {
                // News Headline
                $('.news-headline').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                    vertical: true,
                    variableWidth: false,
                    autoplay: true,
                    autoplaySpeed: 2500,
                    arrows: false,
                });

                function clock() {
                    var date = new Date();
                    var hours = date.getHours();
                    var minutes = date.getMinutes();
                    var ampm = hours >= 12 ? 'pm' : 'am';
                    hours = hours % 12;
                    hours = hours ? hours : 12; // the hour '0' should be '12'
                    minutes = minutes < 10 ? '0' + minutes : minutes;
                    var strTime = hours + ':' + minutes + ' ' + ampm;
                    var time = hours + ':' + minutes + ' ' + ampm;
                    $('#time').text(time);
                }

                setInterval(clock, 1000);
            });
        </script>
    @endpush
</div>
