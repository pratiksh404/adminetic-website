<div class="row">
    <div class="col-lg-12">
        <label for="title">Image Title</label>
        <div class="input-group">
            <input type="text" name="title" id="title" class="form-control" value="{{$image->title ?? old('title')}}"
                placeholder="Image Title">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-6">
        <label for="image">Image</label> <br>
        <input type="file" name="image" id="image" accept="image/*" onchange="readURL(this);">
    </div>
    <div class="col-lg-6">
        @if (isset($image->image))
        <img src="{{asset($image->thumbnail('image','small'))}}" alt="{{$image->name ?? ''}}" class="img-fluid"
            id="image_image">
        @endif
        <img src="" id="image_image_plcaeholder" class="img-fluid">
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-3">
        <label for="type">Image Type</label>
        <div class="input-group">
            <select name="type" id="type" class="form-control select2">
                <option>Select Image Type</option>
                <option value="1" {{isset($image->type) ? ($image->type == "Normal" ? "selected" : "") : "selected"}}>
                    Normal
                </option>
                <option value="2" {{isset($image->type) ? ($image->type == "Horizontal" ? "selected" : "") : ""}}>
                    Horizontal
                </option>
                <option value="3" {{isset($image->type) ? ($image->type == "Vertical" ? "selected" : "") : ""}}>
                    Vertical</option>
                <option value="4" {{isset($image->type) ? ($image->type == "Slider" ? "selected" : "") : ""}}>Slider
                </option>
            </select>
        </div>
    </div>
    <div class="col-lg-9">
        <label for="url">Url</label>
        <div class="input-group">
            <input type="text" name="url" id="url" class="form-control" value="{{$image->url ?? old('url')}}"
                placeholder="Url">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <label for="excerpt">Excerpt</label>
        <textarea name="excerpt" id="excerpt" cols="30" rows="10" class="texteditor">
                    @isset($image->excerpt)
                        {!! $image->excerpt !!}
                    @endisset
                </textarea>
    </div>
</div>
<x-adminetic-edit-add-button :model="$image ?? null" name="Image" />