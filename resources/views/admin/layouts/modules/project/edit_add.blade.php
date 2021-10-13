<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="name">Project Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{$project->name ?? old('name')}}" placeholder="Project Name">
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
                                    <input type="file" name="image" id="image" accept="image/*"
                                        onchange="readURL(this);">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                @if (isset($project->image))
                                <img src="{{asset($project->thumbnail('image','small'))}}"
                                    alt="{{$project->name ?? ''}}" class="img-fluid" id="project_image">
                                @endif
                                <img src="" id="project_image_plcaeholder" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="link">Link</label>
                        <div class="input-group">
                            <input type="text" name="link" id="link" class="form-control"
                                value="{{$project->link ?? old('link') ?? " #"}}" placeholder="Link">
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
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="card-name">SEO</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="meta_name">SEO Title</label>
                            <div class="input-group">
                                <input type="text" name="meta_name" id="meta_name" class="form-control"
                                    value="{{$facility->meta_name ?? old('meta_name')}}" placeholder="SEO Title">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="meta_description">Meta Description</label>
                            <div class="input-group">
                                <textarea name="meta_description" id="meta_description"
                                    style="width:100%">@isset($facility->meta_description){{$facility->meta_description}}@endisset</textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="meta_keywords">Meta Keywords</label>
                            <div class="input-group">
                                <select name="meta_keywords[]" id="meta_keywords" class="tags form-control" multiple>
                                    @isset($facility->meta_keywords)
                                    @foreach ($facility->meta_keywords as $meta_keyword)
                                    <option value="{{$meta_keyword}}" selected>{{$meta_keyword}}</option>
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-adminetic-edit-add-button :model="$project ?? null" name="Project" />