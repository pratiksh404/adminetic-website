<div class="row">
    <div class="col-12">
        <label for="name">Guest Name <span class="text-danger">*</span></label>
        <input type="text" name="name" id="name" class="form-control" value="{{$guest->name ?? old('name')}}"
            placeholder="Guest Name">
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-6">
        <label for="image">Guest Image</label> <br>
        <input type="file" name="image" id="image" accept="image/*" onchange="readURL(this);">
    </div>
    <div class="col-lg-6 d-flex justify-content-center">
        @if (isset($guest))
        @if (!is_null($guest->getRawOriginal('image')))
        <br>
        <img src="{{ $guest->image }}" alt="{{ $guest->name ?? '' }}" class="img-fluid" id="guest_image">
        @endif
        @endif
        <img src="" id="guest_image_placeholder" width="100" class="img-fluid">
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <label for="description">Description</label>
        <textarea name="description" id="heavytexteditor">
            @isset($guest)
                {!! $guest->description !!}
            @endisset
        </textarea>
    </div>
</div>
<hr>
<x-adminetic-edit-add-button :model="$guest ?? null" name="Guest" />