<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="title">Page Title</label>
                                    <div class="input-group">
                                        <input type="text" name="title" id="title" class="form-control"
                                            value="{{$page->title ?? old('title')}}" placeholder="Page Title">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="row">
                            <label for="body">Body</label>
                            <textarea name="body" id="heavytexteditor" class="body form-control" style="width: 100%">
                                                                    @isset($page->body)
                                                                     {!! $page->body !!}        
                                                                    @endisset
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <x-adminetic-edit-add-button :model="$page ?? null" name="Page" />
        </div>
    </div>
    <div class="col-lg-4" style="height:80vh;overflow-y:auto">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="code">Code</label>
                                    <div class="input-group">
                                        <button class="btn btn-primary" type="button" id="code_reload"><i
                                                class="fa fa-sync"></i></button>
                                        <input type="text" name="code" id="code" class="form-control"
                                            value="{{$facility->code ?? old('code')}}" placeholder="Stay Code"
                                            aria-describedby="code_reload_append">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="image">Page Image</label> <br>
                                            <input type="file" name="image" id="image" accept="image/*"
                                                onchange="readURL(this);">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-12 d-flex justify-content-center">
                                            @if (isset($page->image))
                                            <br>
                                            <img src="{{asset($page->thumbnail('image','small'))}}"
                                                alt="{{$page->name ?? ''}}" class="img-fluid" id="page_image">
                                            @endif
                                            <img src="" id="page_image_plcaeholder" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="video">Youtube Video</label>
                                    <div class="input-group">
                                        <input type="text" name="video" id="video" class="form-control"
                                            value="{{$page->video ?? old('video')}}" placeholder="Youtube Video">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="type">Page Type</label>
                                    <div class="input-group">
                                        <select name="type" id="type" class="select2 form-control">
                                            <option selected disabled>Select Page Type ..</option>
                                            <option value="1"
                                                {{isset($page) ? ($page->type == "Event" ? "selected" : "") : ""}}>
                                                Event
                                            </option>
                                            <option value="2"
                                                {{isset($page) ? ($page->type == "Case Study" ? "selected" : "") : "selected"}}>
                                                Case Study</option>
                                            <option value="3"
                                                {{isset($page) ? ($page->type == "Vacancy Announcement" ? "selected" : "") : ""}}>
                                                Vacancy Announcement</option>
                                            <option value="4"
                                                {{isset($page) ? ($page->type == "Custom Page" ? "selected" : "") : ""}}>
                                                Custom Page</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="switch1">Active ?</label> <br>
                                    <label class="switch">
                                        <input type="hidden" name="active" value="0">
                                        <input name="active" type="checkbox" value="1" id="active"
                                            {{isset($page->active) ? ($page->active ? 'checked' : '') : 'checked'}}><span
                                            class="switch-state"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h4 class="card-title">SEO</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="seo_title">SEO Title</label>
                                    <div class="input-group">
                                        <input type="text" name="seo_title" id="seo_title" class="form-control"
                                            value="{{$page->seo_title ?? old('seo_title')}}" placeholder="SEO Title">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="meta_description">Meta Description</label>
                                    <div class="input-group">
                                        <textarea name="meta_description" id="meta_description"
                                            style="width:100%">@isset($page->meta_description){{$page->meta_description}}@endisset</textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="meta_keywords">Meta Keywords</label>
                                    <div class="input-group">
                                        <select name="meta_keywords[]" id="meta_keywords" class="tags form-control"
                                            multiple>
                                            @isset($page->meta_keywords)
                                            @foreach ($page->meta_keywords as $meta_keyword)
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
    </div>