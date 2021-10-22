<div class="row">
    <div class="col-lg-4">
        <div class="mb-2">
            <label for="name">Block Name <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" name="name" id="name" class="form-control" value="{{$block->name ?? old('name')}}"
                    placeholder="Block Name">
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-2">
            <label for="location">Partial File Location <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" name="location" id="location" class="form-control"
                    value="{{$block->location ?? old('location')}}" placeholder="e.g. website.block.file">
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-2">
            <label for="page">Block Main Domain (Page) (Select or create one)</label>
            <div class="input-group">
                <select name="page" id="page" class="page">
                    <option selected disabled>Select Block Domain (e.g home,contact) ... </option>
                    @isset($block_domains)
                    @if (count($block_domains) > 0)
                    @foreach (array_unique($block_domains) as $block_domain)
                    <option value="{{$block_domain}}" {{isset($block->page) ? ($block->page == $block_domain ?
                        'selected' : '') : ''}}>{{$block_domain}}</option>
                    @endforeach
                    @endif
                    @endisset
                </select>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-3">
        <label for="image">Block Image</label>
        <input type="file" name="image" id="image" accept="image/*" onchange="readURL(this);">
    </div>
    <div class="col-lg-3">
        @if (isset($block->image))
        <img src="{{asset('storage/' . $block->image)}}" alt="{{$block->name}}" width="120" class="img-fluid">
        @endif
        <img src="" id="block_image_plcaeholder" class="img-fluid">
    </div>
    <div class="col-lg-3">
        <div class="mb-2">
            <label for="type">Block Type (Select or create one)</label>
            <div class="input-group">
                <select name="type" id="type" class="type">
                    <option selected disabled>Select Block Type (e.g banner,header,footer) ... </option>
                    @isset($block_types)
                    @if (count($block_types) > 0)
                    @foreach (array_unique($block_types) as $block_type)
                    <option value="{{$block_type}}" {{isset($block->type) ? ($block->type == $block_type ?
                        'selected' : '') : ''}}>{{$block_type}}</option>
                    @endforeach
                    @endif
                    @endisset
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="mb-2">
            <label for="version">Version <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="number" name="version" id="version" class="touchspin"
                    value="{{$block->version ?? old('version') ?? 1}}">
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <label for="active">Active</label>
        <div class="mb-2">
            <label class="switch">
                <input type="hidden" name="active" value="0">
                <input name="active" type="checkbox" value="1" id="active" {{isset($block->active) ? ($block->active ?
                'checked' : '') : 'checked'}}><span class="switch-state"></span>
            </label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="mb-2">
            <label for="theme">Theme</label>
            <div class="input-group">
                <select name="theme" id="theme" class="select2" style="width: 100%">
                    <option selected disabled>Select Theme ... </option>
                    @foreach (config('website.block_group_themes',array(1)) as $theme)
                    <option value="{{$theme}}" {{isset($block->theme) ? ($block->theme == $theme ? 'selected' : '') :
                        ''}}>Theme {{$theme}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <label for="body">Body</label>
        <textarea name="body" id="heavytexteditor">
            @isset($block->body)
                {!! $block->body !!}
            @endisset
        </textarea>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="mb-3" style="position: static;">
            <label for="setting">Setting</label>
            <input type="hidden" name="setting" data-setting="{{ $block->setting ?? '' }}" id="setting">
            <div class="ace-editor" id="editor">

            </div>
        </div>
    </div>
</div>
<x-adminetic-edit-add-button :model="$block ?? null" name="Block" />