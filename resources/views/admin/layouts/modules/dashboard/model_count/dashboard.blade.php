@if (config('website.model_count_dashboard_active',true))
<div class="row">
    <div class="col-lg-3">
        <div class="card shadow-lg">
            <div class="card-body p-3 bg-primary">
                <h6>Services:- </h6><br>
                <h3>{{\Adminetic\Website\Models\Admin\Service::count()}}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card shadow-lg">
            <div class="card-body p-3 bg-secondary">
                <h6>Facilities:- </h6><br>
                <h3>{{\Adminetic\Website\Models\Admin\Facility::count()}}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card shadow-lg">
            <div class="card-body p-3 bg-info">
                <h6>Posts:- </h6><br>
                <h3>{{\Adminetic\Website\Models\Admin\Post::count()}}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card shadow-lg">
            <div class="card-body p-3 bg-danger">
                <h6>Projects:- </h6><br>
                <h3>{{\Adminetic\Website\Models\Admin\Project::count()}}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card shadow-lg">
            <div class="card-body p-3 bg-danger">
                <h6>Teams:- </h6><br>
                <h3>{{\Adminetic\Website\Models\Admin\Team::count()}}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card shadow-lg">
            <div class="card-body p-3 bg-info">
                <h6>Events:- </h6><br>
                <h3>{{\Adminetic\Website\Models\Admin\Event::count()}}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card shadow-lg">
            <div class="card-body p-3 bg-secondary">
                <h6>Galleries:- </h6><br>
                <h3>{{\Adminetic\Website\Models\Admin\Gallery::count()}}</h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card shadow-lg">
            <div class="card-body p-3 bg-primary">
                <h6>Images:- </h6><br>
                <h3>{{\Adminetic\Website\Models\Admin\Image::count()}}</h3>
            </div>
        </div>
    </div>
</div>
@endif