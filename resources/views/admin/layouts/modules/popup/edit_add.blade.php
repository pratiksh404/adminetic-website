<div class="row">
    <div class="col-lg-6">
        <div class="mb-2">
            <label for="name">Popup Name</label>
            <div class="input-group">
                <input type="text" name="name" id="name" class="form-control" value="{{$popup->name ?? old('name')}}"
                    placeholder="Popup Name">
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-2">
            <label for="url">URL</label>
            <div class="input-group">
                <input type="text" name="url" id="url" class="form-control" value="{{$popup->url ?? old('url')}}"
                    placeholder="URL">
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-6">
        <label for="image">Image<span class="text-danger">*</span></label> <br>
        <input type="file" name="image" id="image" accept="image/*" onchange="readURL(this);">
    </div>
    <div class="col-lg-6">
        @if (isset($popup->image))
        <img src="{{asset('storage/' . $popup->image)}}" alt="{{$popup->name ?? ''}}" class="img-fluid"
            id="popup_image">
        @endif
        <img src="" id="popup_image_plcaeholder" class="img-fluid">
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <label for="body">Body</label>
        <textarea name="body" id="heavytexteditor">
            @isset($popup->body)
                {!! $popup->body !!}
            @endisset
        </textarea>
    </div>
</div>
<x-adminetic-edit-add-button :model="$popup ?? null" name="Popup" />