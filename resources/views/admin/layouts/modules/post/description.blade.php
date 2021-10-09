<div class="row">
    <div class="col-lg-3">
        <ul class="list-group">
            <li class="list-group-item">
                <b>Code :</b><span class="text-muted">{{$post->code ?? 'N/A'}}</span>
            </li>
            <li class="list-group-item">
                <b>Slug :</b><span class="text-muted">{{$post->slug ?? 'N/A'}}</span>
            </li>
            <li class="list-group-item">
                <b>Author :</b><span class="text-muted">{{$post->author->name ?? 'N/A'}}</span>
            </li>
            <li class="list-group-item">
                <b>Category :</b><span class="text-muted">{{$post->category->name ?? 'N/A'}}</span>
            </li>
            <li class="list-group-item">
                <b>Name :</b><span class="text-muted">{{$post->name ?? 'N/A'}}</span>
            </li>
            <li class="list-group-item">
                <b>Status :</b><span class="badge badge-{{$post->statusColor()}}">{{$post->status ?? 'N/A'}}</span>
            </li>
            <li class="list-group-item">
                <b>Featured :</b><span
                    class="badge badge-{{$post->featured ? 'success' : 'danger'}}">{{$post->featured ? 'Yes' : 'No'}}</span>
            </li>
            <li class="list-group-item">
                <b>Priority :</b><span class="text-muted">{{$post->priority ?? 'N/A'}}</span>
            </li>
            <li class="list-group-item">
                <b>Breaking News :</b><span
                    class="badge badge-{{$post->breaking_news ? 'success' : 'danger'}}">{{$post->breaking_news ? 'Yes' : 'No'}}</span>
            </li>
            <li class="list-group-item">
                <b>Hot News :</b><span
                    class="badge badge-{{$post->hot_news ? 'success' : 'danger'}}">{{$post->hot_news ? 'Yes' : 'No'}}</span>
            </li>
        </ul>
        <hr>
        @isset($post->image)
        <div class="row">
            <div class="col-lg-12">
                <img src="{{asset($post->thumbnail('image','medium'))}}" alt="{{$post->name}}" class="img-fluid">
            </div>
        </div>
        @endisset
    </div>
    <div class="col-lg-6">
        @isset($post->excerpt)
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <b>Excerpt :- </b>
                <hr>
                {!! $post->excerpt !!}
            </div>
        </div>
        @endisset
        @isset($post->body)
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <b>Body :- </b>
                <hr>
                {!! $post->body !!}
            </div>
        </div>
        @endisset
    </div>
    <div class="col-lg-3">
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <li class="list-group-item">
                    <b>SEO Name :</b><span class="text-muted">{{$post->seo_name ?? 'N/A'}}</span>
                </li>
                <li class="list-group-item">
                    <b>SEO Description:</b><span class="text-muted">{{$post->meta_description ?? 'N/A'}}</span>
                </li>
                @isset($post->meta_keywords)
                <li class="list-group-item">
                    <b>SEO Keywords:</b>
                    <hr>
                    @foreach ($post->meta_keywords as $meta_keyword)
                    <span class="badge badge-primary">{{$meta_keyword}}</span>
                    @endforeach
                </li>
                @endisset
            </div>
        </div>
    </div>
</div>