@isset($team)
    @if (count($team->social_medias ?? []) > 0)
        @if (isset($team->social_medias['facebook']))
            <a href="{{ $team->social_medias['facebook'] }}" class="m-5"><i class="fab fa-facebook"></i></a>
        @endif
        @if (isset($team->social_medias['email']))
            <a href="{{ $team->social_medias['email'] }}" class="m-5"><i class="fa fa-envelope"></i></a>
        @endif
        @if (isset($team->social_medias['instagram']))
            <a href="{{ $team->social_medias['instagram'] }}" class="m-5"><i class="fab fa-instagram"></i></a>
        @endif
        @if (isset($team->social_medias['messenger']))
            <a href="{{ $team->social_medias['messenger'] }}" class="m-5"><i class="fab fa-facebook-messenger"></i></a>
        @endif
        @if (isset($team->social_medias['twitter']))
            <a href="{{ $team->social_medias['twitter'] }}" class="m-5"><i class="fab fa-twitter"></i></a>
        @endif
        @if (isset($team->social_medias['linkedin']))
            <a href="{{ $team->social_medias['linkedin'] }}" class="m-5"><i class="fab fa-linkedin"></i></a>
        @endif
        @if (isset($team->social_medias['github']))
            <a href="{{ $team->social_medias['github'] }}" class="m-5"><i class="fab fa-github"></i></a>
        @endif
        @if (isset($team->social_medias['whatsapp']))
            <a href="{{ $team->social_medias['whatsapp'] }}" class="m-5"><i class="fab fa-whatsapp"></i></a>
        @endif
    @endif
@endisset
