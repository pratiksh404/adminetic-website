@isset($most_viewed_posts)
@if ($most_viewed_posts)
<div class="row">
    <b>Most Viewed Posts</b>
    @foreach ($most_viewed_posts as $most_viewed_post)
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title">
                    <div class="row">
                        <div class="col-lg-10">
                            <a
                                href="{{ adminShowRoute('post',$most_viewed_post->id) }}">{{ $most_viewed_post->optimized_title }}</a>
                        </div>
                        <div class="col-lg-2">
                            <b>{{ views($most_viewed_post)->count() }}</b>
                        </div>
                    </div>
                </h4>
                <p class="card-text">
                    {{ $most_viewed_post->optimized_excerpt }}
                </p>
            </div>
        </div>
        <div class="card-footer text-muted">
            <span class="float-left"> {{ $most_viewed_post->category->name }}</span>
            <span class="float-right"> {{ $most_viewed_post->updated_at->toFormattedDateString() }}</span>
        </div>
    </div>
    @endforeach
</div>
@endif
@endisset