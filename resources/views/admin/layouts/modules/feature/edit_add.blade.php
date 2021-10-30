<div class="row">
    <div class="col-lg-8">
        <div class="mb-2">
            <label for="name">Feature Name <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" name="name" id="name" class="form-control" value="{{$feature->name ?? old('name')}}"
                    placeholder="Feature Name">
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <label for="icon">Icon</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i id="showIcon" class="fas fa-icons"></i></span>
            </div>
            <button type="button" class="btn btn-primary" id="iconPicker" data-iconpicker-input="#icon"
                data-iconpicker-preview="#showIcon">Select Icon</button>
            <input type="hidden" name="icon" id="icon"
                value="{{$feature->icon ?? old('icon') ?? 'fas fa-concierge-bell'}}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <label for="image">Icon PNG Image</label>
        <div class="input-group">
            <input type="file" name="image" id="image" accept="image/*" onchange="readIconURL(this);">
        </div>
    </div>
    <div class="col-lg-6">
        @if (isset($feature->image))
        <img src="{{asset('storage/'.$feature->image)}}" alt="{{$feature->name ?? ''}}" class="img-fluid"
            id="feature_icon" style="width: 60px">
        @endif
        <img src="" id="feature_icon_plcaeholder" class="img-fluid">
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <label for="description">Description <span class="text-danger">*</span></label>
        <textarea name="description" id="heavytexteditor">
            @isset($feature->description)
                {!! $feature->description !!}
            @endisset
        </textarea>
    </div>
</div>
<x-adminetic-edit-add-button :model="$feature ?? null" name="Feature" />