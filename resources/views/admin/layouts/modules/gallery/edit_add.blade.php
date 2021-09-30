<div class="row">
    <div class="col-lg-2">
        <label for="code">Code</label>
        <div class="input-group">
            <button class="btn btn-primary" type="button" id="code_reload"><i class="fa fa-sync"></i></button>
            <input type="text" name="code" id="code" class="form-control" value="{{$facility->code ?? old('code')}}"
                placeholder="Stay Code" aria-describedby="code_reload_append">
        </div>
    </div>
    <div class="col-lg-8">
        <label for="name">Gallery Name</label>
        <div class="input-group">
            <input type="text" name="name" id="name" class="form-control" value="{{$gallery->name ?? old('name')}}"
                placeholder="Gallery Name">
        </div>
    </div>
    <div class="col-lg-2">
        <label for="type">Type</label>
        <div class="input-group">
            <select name="type" id="type" class="select2">
                <option selected disabled>Select Type...</option>
                <option value="1" {{isset($gallery) ? ($gallery->type == "Image" ? "selected" : "") : "selected"}}>
                    Image</option>
                <option value="2" {{isset($gallery) ? ($gallery->type == "Video" ? "selected" : "") : ""}}>Video
                </option>
            </select>
        </div>
    </div>
    <br>
</div>
<br>
<div class="row">
    <div class="col-lg-4">
        <input type="file" name="images[]" id="images" accept="image/*" multiple>
    </div>
    <div class="col-lg-8 gallery_images d-flex justify-content-center" style="overflow-x:scroll">
    </div>
    @if (isset($gallery->images))
    <div class="col-lg-12">
        <hr>
        @livewire('admin.gallery.gallery-images', ['gallery_id' => $gallery->id])
    </div>
    @endif
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <label for="url">Video Urls <small>Required if type is video</small></label>
        <div class="input-group">
            <select name="url[]" class="urls form-control" multiple="">
                @if (isset($gallery->url))
                @foreach ($gallery->url as $url)
                <option value="{{$url}}" selected>{{$url}}
                </option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <label for="excerpt">Excerpt</label>

        <textarea name="excerpt" id="heavytexteditor" class="form-control">
                                    @isset($gallery->excerpt)
                                        {!! $gallery->excerpt !!}
                                    @endisset
                                </textarea>

    </div>
</div>
<x-adminetic-edit-add-button :model="$gallery ?? null" name="Gallery" />