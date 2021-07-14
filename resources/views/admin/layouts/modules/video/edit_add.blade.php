<div class="row">
    <div class="col-lg-4">
        <label for="name">Name</label>
        <div class="input-group">
            <input type="text" name="name" id="name" class="form-control" value="{{$video->name ?? old('name')}}"
                placeholder="Name">
        </div>
    </div>
    <div class="col-lg-8">
        <label for="url">Embed URL Link <span class="text-danger">*</span></label>
        <div class="input-group">
            <input type="text" name="url" id="url" class="form-control" value="{{$video->url ?? old('url')}}"
                placeholder="Embed URL Link">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-3">
        <label for="gallery_id">Gallery</label>
        <div class="input-group">
            <select name="gallery_id" id="gallery_id" class="select2" style="width: 100%">
                <option selected disabled>Select Gallery ... </option>
                @isset($galleries)
                @foreach($galleries as $gallery)
                <option value="{{$gallery->id}}">{{$gallery->name}}</option>
                @endforeach
                @endisset
            </select>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-6">
                <label for="thumbnail">Course Thumbnail</label>
                <div class="input-group">
                    <input type="file" name="thumbnail" id="thumbnail" accept="thumbnail/*" onchange="readURL(this);">
                </div>
            </div>
            <div class="col-lg-6">
                @if (isset($video->thumbnail))
                <img src="{{asset($video->thumbnail('thumbnail','small'))}}" alt="{{$video->name}}">
                @endif
                <img src="" id="video_thumbnail_plcaeholder" class="img-fluid">
            </div>
        </div>
    </div>
</div>
<x-adminetic-edit-add-button :model="$video ?? null" name="Video" />