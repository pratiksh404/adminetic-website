<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="name">{{ label('software', 'name') }}</label>
                        <div class="input-group">
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $software->name ?? old('name') }}" placeholder="software Name">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="excerpt">{{ label('software', 'excerpt') }}</label>
                        <div class="input-group">
                            <textarea name="excerpt" id="excerpt" cols="30" rows="20" class="form-control">{{ $software->excerpt ?? old('excerpt') }}</textarea>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="excerpt">{{ label('software', 'description') }}</label>
                        <div class="input-group">
                            <textarea name="description" id="heavytexteditor" cols="30" rows="20" class="form-control">
                                @isset($software->description)
{!! $software->description !!}
@endisset
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <x-adminetic-edit-add-button :model="$software ?? null" name="Service" />
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <label for="type">{{ label('software', 'type') }}</label>
                <input type="text" name="type" id="type" class="form-control"
                    value="{{ $software->type ?? old('type') }}" placeholder="Software Type ..">
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                @livewire('admin.category.quick-category', ['model' => 'Service', 'category_id' => $software->category_id ?? null, 'attribute' => 'category_id'])
            </div>
        </div>
        <div class="card" style="height:60vh;overflow-y:auto">
            <div class="card-body shadow-lg p-3">
                @livewire('admin.software.software-modules', ['software' => $software ?? null])
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Service Images
            </div>
            <div class="card-body shadow-lg p-3">
                <b>Banner</b> <br>
                @livewire('admin.system.upload-image', ['model' => $software ?? null, 'attribute' => 'banner'], key('software_banner'))
                <hr>
                <b>Images</b> <br>
                @livewire('admin.system.upload-image', ['model' => $software ?? null, 'attribute' => 'images', 'multiple' => true], key('software_images'))
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-lg-6">
                        <label>{{ label('software', 'active') }}</label> <br>
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" name="active" id="active" value="1"
                            {{ isset($software->active) ? ($software->active ? 'checked' : '') : 'checked' }}>
                    </div>
                    <div class="col-lg-6">
                        <label>{{ label('software', 'featured') }}</label> <br>
                        <input type="hidden" name="featured" value="0">
                        <input type="checkbox" name="featured" id="featured" value="1"
                            {{ isset($software->featured) ? ($software->featured ? 'checked' : '') : '' }}>
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <label for="icon">{{ label('software', 'icon') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i id="showIcon" class="fa fa-concierge-bell"></i></span>
                        <button type="button" class="btn btn-primary" id="iconPicker" data-iconpicker-input="#icon"
                            data-iconpicker-preview="#showIcon">Select
                            Icon</button>
                        <input type="hidden" name="icon" id="icon"
                            value="{{ $software->icon ?? (old('icon') ?? 'fa fa-concierge-bell') }}">
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <label for="color">{{ label('software', 'color') }}</label>
                    <input type="color" name="color" id="color" value="{{ $software->color ?? old('color') }}">
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="mt-4">
                    <label for="meta_name">{{ label('software', 'meta_name', 'Meta Name') }}</label>
                    <div class="input-group">
                        <input type="text" name="meta_name" id="meta_name" class="form-control"
                            value="{{ $software->meta_name ?? old('meta_name') }}" placeholder="Meta Name">
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <label
                        for="meta_description">{{ label('software', 'meta_description', 'Meta Description') }}</label>
                    <textarea name="meta_description" id="meta_description" cols="30" rows="10" class="form-control">{{ $software->meta_description ?? old('meta_description') }}</textarea>
                </div>
                <br>
                <div class="mt-4">
                    <label for="meta_keywords">{{ label('software', 'meta_keywords', 'Meta Keywords') }}</label>
                    <div class="input-group">
                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                            value="{{ $software->meta_keywords ?? old('meta_keywords') }}"
                            placeholder="Meta Keywords">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
