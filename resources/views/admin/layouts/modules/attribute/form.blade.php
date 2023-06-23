<div class="row">
    <div class="col-lg-3">
        <div class="mb-2">
            <label for="code">Attribute Code <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" name="code" id="code" class="form-control"
                    value="{{ $attribute->code ?? old('code') }}" placeholder="Attribute Code">
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="mb-2">
            <label for="name">Attribute Name <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ $attribute->name ?? old('name') }}" placeholder="Attribute Name">
            </div>
        </div>
    </div>
    <div class="col-lg-4" id="color_section" style="display: hidden">
        <label for="color">Colors(Change colors to further add color values)</label>
        <input class="form-control form-control-color" type="color" id="color" value="#563d7c"
            onchange="colorChanged(this);">
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <label for="values">Values</label>
        <div class="input-group">
            <select name="values[]" id="values" class="tag" multiple>
                @isset($attribute->values)
                    @foreach ($attribute->values as $meta_keyword)
                        <option value="{{ $meta_keyword }}" selected>{{ $meta_keyword }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
    </div>
</div>
<x-adminetic-edit-add-button :model="$attribute ?? null" name="Attribute" />
