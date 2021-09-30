<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="name">Facility Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{$service->name ?? old('name')}}" placeholder="Facility Name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        @livewire('admin.category.quick-category', ['model' => 'Facility','category_id' => $category->id
                        ??
                        null])
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <label for="excerpt">Facility Excerpt <span class="text-danger">*</span></label>
                        <textarea name="excerpt" id="excerpt" class="form-control" cols="30"
                            rows="10">{{$service->excerpt ?? ''}}</textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <label for="description">Facility Description</label>
                        <textarea name="description" id="heavytexteditor" cols="30"
                            rows="10">{{$service->excerpt ?? ''}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <x-adminetic-edit-add-button :model="$service ?? null" name="Facility" />
    </div>
    <div class="col-lg-4">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="code">Code</label>
                        <div class="input-group">
                            <button class="btn btn-primary" type="button" id="code_reload"><i
                                    class="fa fa-sync"></i></button>
                            <input type="text" name="code" id="code" class="form-control"
                                value="{{$service->code ?? old('code')}}" placeholder="Stay Code"
                                aria-describedby="code_reload_append">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <label for="active">Active</label>
                        <div class="mb-2">
                            <label class="switch">
                                <input type="hidden" name="active" value="0">
                                <input name="active" type="checkbox" value="1" id="active"
                                    {{isset($service->active) ? ($service->active ? 'checked' : '') : 'checked'}}><span
                                    class="switch-state"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shaodw-lg">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="icon_image">Icon PNG Image</label>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <input type="file" name="icon_image" id="icon_image" accept="image/*"
                                        onchange="readIconURL(this);">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                @if (isset($service->icon_image))
                                <img src="{{asset('storage/'.$service->icon_image)}}" alt="{{$service->name ?? ''}}"
                                    class="img-fluid" id="service_icon" style="width: 60px">
                                @endif
                                <img src="" id="service_icon_plcaeholder" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <label for="icon">Icon</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i id="showIcon"
                                        class="fas fa-icons"></i></span>
                            </div>
                            <button type="button" class="btn btn-primary" id="iconPicker" data-iconpicker-input="#icon"
                                data-iconpicker-preview="#showIcon">Select Icon</button>
                            <input type="hidden" name="icon" id="icon"
                                value="{{$service->icon ?? old('icon') ?? 'fas fa-concierge-bell'}}">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <label for="image">Facility Image</label>
                        <input type="file" name="image" id="image" accept="image/*" onchange="readURL(this);">
                    </div>
                    <div class="col-lg-12">
                        @if (isset($service->image))
                        <img src="{{asset($service->thumbnail('image','small'))}}" alt="{{$service->name}}">
                        @endif
                        <img src="" id="service_image_plcaeholder" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="card-name">SEO</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="meta_name">SEO Title</label>
                            <div class="input-group">
                                <input type="text" name="meta_name" id="meta_name" class="form-control"
                                    value="{{$service->meta_name ?? old('meta_name')}}" placeholder="SEO Title">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="meta_description">Meta Description</label>
                            <div class="input-group">
                                <textarea name="meta_description" id="meta_description"
                                    style="width:100%">@isset($service->meta_description){{$service->meta_description}}@endisset</textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="meta_keywords">Meta Keywords</label>
                            <div class="input-group">
                                <select name="meta_keywords[]" id="meta_keywords" class="tags form-control" multiple>
                                    @isset($service->meta_keywords)
                                    @foreach ($service->meta_keywords as $meta_keyword)
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