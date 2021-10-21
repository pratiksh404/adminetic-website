<div class="row">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ \Adminetic\Website\Models\Admin\Post::tenent()->count() ?? 'N/A' }}</h3>
                <span>Total Posts</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ \Adminetic\Website\Models\Admin\Post::tenent()->published()->count() ?? 'N/A' }}</h3>
                <span>Published Posts</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ \Adminetic\Website\Models\Admin\Post::tenent()->pending()->count() ?? 'N/A' }}</h3>
                <span>Pending Posts</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ \Adminetic\Website\Models\Admin\Post::tenent()->draft()->count() ?? 'N/A' }}</h3>
                <span>Draft Posts</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ \Adminetic\Website\Models\Admin\Post::tenent()->featured()->count() ?? 'N/A' }}</h3>
                <span>Featured Posts</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ \Adminetic\Website\Models\Admin\Post::tenent()->hotNews()->count() ?? 'N/A' }}</h3>
                <span>Hot News</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ \Adminetic\Website\Models\Admin\Post::tenent()->breakingNews()->count() ?? 'N/A' }}</h3>
                <span>Breaking News</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow-lg">
            <div class="card-body bg-primary">
                <h3>{{ \Adminetic\Website\Models\Admin\Post::tenent()->video()->count() ?? 'N/A' }}</h3>
                <span>Video Posts</span>
            </div>
        </div>
    </div>
</div>