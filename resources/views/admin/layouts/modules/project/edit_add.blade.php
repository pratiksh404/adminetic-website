<div class="row">
    <div class="col-lg-12">
        <label for="name">Project Name <span class="text-danger">*</span></label>
        <div class="input-group">
            <input type="text" name="name" class="form-control" id="name" value="{{$project->name ?? old('name')}}"
                placeholder="Project Name">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-4">
        <label for="client_id">Project Client <span class="text-danger">*</span></label>
        <div class="input-group">
            <input type="text" name="client" id="client" class="form-control"
                value="{{$project->client ?? old('client')}}" placeholder="Client Name">
        </div>
    </div>
    <div class="col-lg-4">
        <label for="duration">Duration <span class="text-danger">*</span></label>
        <div class="input-group">
            <input type="text" name="duration" id="duration" class="form-control"
                value="{{$project->duration ?? old('duration')}}" placeholder="Duration">
        </div>
    </div>
    <div class="col-lg-4">
        <label for="category">Category <span class="text-danger">*</span></label>
        <div class="input-group">
            <input type="text" name="category" id="category" class="form-control"
                value="{{$project->category ?? old('category')}}" placeholder="Category">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-6">
                <label for="image">Project Image</label>
                <div class="input-group">
                    <input type="file" name="image" id="image" accept="image/*" onchange="readURL(this);">
                </div>
            </div>
            <div class="col-lg-6">
                @if (isset($project->image))
                <img src="{{asset($project->thumbnail('image','small'))}}" alt="{{$project->name ?? ''}}"
                    class="img-fluid" id="project_image">
                @endif
                <img src="" id="project_image_plcaeholder" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <label for="link">Link</label>
        <div class="input-group">
            <input type="text" name="link" id="link" class="form-control"
                value="{{$project->link ?? old('link') ?? "#"}}" placeholder="Link">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <label for="description">Description</label>
        <textarea name="description" id="heavytexteditor">
                @isset($project->description)
                    {!! $project->description !!}
                @endisset
            </textarea>
    </div>
</div>
<x-adminetic-edit-add-button :model="$project ?? null" name="Project" />