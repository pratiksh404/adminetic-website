<div class="row">
    <div class="col-lg-2">
        <div class="mb-3">
            <label class="form-label">Code</label>
            <div class="input-group">
                <button class="btn btn-outline-primary p-2" type="button" id="code_reload"><i
                        class="fa fa-sync"></i></button>
                <input name="code" type="number" class="form-control" id="code"
                    value="{{$category->code ?? old('category')}}" placeholder="Code">
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="mb-2">
            <label for="name" class="form-label">Category Name</label>
            <div class="input-group">
                <input type="text" name="name" id="name" class="form-control" value="{{$category->name ?? old('name')}}"
                    placeholder="Category Name">
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="mb-2">
            <label for="parant_id" class="form-label">Category Parent</label>
            <div class="input-group">
                <select name="parant_id" id="parant_id" class="select2" style="width:100%">
                    <option selected disabled>Select Category Parant ... </option>
                    @isset($categories)
                    @foreach ($categories as $parent_category)
                    @if (!isset($parent_category->parent_id))
                    <option value="{{$parent_category->id}}"
                        {{isset($category->parent_id) ? ($category->parent_id == $parent_category->id ? 'selected' : '') : ''}}>
                        {{$parent_category->name}}</option>
                    @endif
                    @endforeach
                    @endisset
                </select>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="mb-2">
            <label for="model">Model</label>
            <div class="input-group">
                <select name="model" id="model" class="select2" style="width:100%">
                    <option selected disabled>Select Model ... </option>
                    @foreach (getAllModelNames(app_path('Models')) as $model)
                    <option value="{{$model}}"
                        {{isset($category->model) ? ($category->model == $model ? 'selected' : '') : ''}}>{{$model}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-2">
        <label for="active">Active</label>
        <div class="mb-2">
            <label class="switch">
                <input type="hidden" name="active" value="0">
                <input name="active" type="checkbox" value="1" id="active"
                    {{isset($category->active) ? ($category->active ? 'checked' : '') : 'checked'}}><span
                    class="switch-state"></span>
            </label>
        </div>
    </div>
    <div class="col-lg-1">
        <div class="mb-2">
            <label for="color">Color</label>
            <div class="input-group">
                <input name="color" class="form-control form-control-color" type="color"
                    value="{{$category->color ?? old('color') ?? '#563d7c'}}">
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="mb-2">
            <label for="icon">Icon</label>
            <div class="input-group">
                <span class="input-group-text"><i id="showIcon" class="fa fa-concierge-bell"></i></span>
                <button type="button" class="btn btn-primary" id="iconPicker" data-iconpicker-input="#icon"
                    data-iconpicker-preview="#showIcon">Select Icon</button>
                <input type="hidden" name="icon" id="icon"
                    value="{{$service->icon ?? old('icon') ?? 'fa fa-concierge-bell'}}">
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-6">
                <label for="image">Category Image</label>
                <input type="file" name="image" id="image" accept="image/*" onchange="readURL(this);">
            </div>
            <div class="col-lg-6">
                @if (isset($category->image))
                <img src="{{asset($category->thumbnail('image','small'))}}" alt="{{$category->name}}">
                @endif
                <img src="" id="category_image_plcaeholder" class="img-fluid">
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <label for="description">Description</label>
        <textarea name="description" id="heavytexteditor" cols="30" rows="10">
            @isset($category->description)
                {!! $category->description !!}
            @endisset
        </textarea>
    </div>
</div>
<x-adminetic-edit-add-button :model="$category ?? null" name="Category" />