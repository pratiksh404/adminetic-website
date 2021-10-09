<div class="row">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ $total_published_posts ?? 'N/A' }}</h3>
                <span>Total Posts</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ $total_posts ?? 'N/A' }}</h3>
                <span>Published Posts</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ $total_pending_posts ?? 'N/A' }}</h3>
                <span>Pending Posts</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ $total_draft_posts ?? 'N/A' }}</h3>
                <span>Draft Posts</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ $total_featured_posts ?? 'N/A' }}</h3>
                <span>Featured Posts</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ $total_hot_news ?? 'N/A' }}</h3>
                <span>Hot News</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ $total_breaking_news ?? 'N/A' }}</h3>
                <span>Breaking News</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ $total_video_posts ?? 'N/A' }}</h3>
                <span>Video Posts</span>
            </div>
        </div>
    </div>
</div>