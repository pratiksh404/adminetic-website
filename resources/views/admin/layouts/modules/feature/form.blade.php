<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="name">{{ label('features', 'name') }}</label>
                        <div class="input-group">
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $feature->name ?? old('name') }}" placeholder="feature Name">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="excerpt">{{ label('features', 'excerpt') }}</label>
                        <div class="input-group">
                            <textarea name="excerpt" id="excerpt" cols="30" rows="20" class="form-control">{{ $feature->excerpt ?? old('excerpt') }}</textarea>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="excerpt">{{ label('features', 'description') }}</label>
                        <div class="input-group">
                            <textarea name="description" id="heavytexteditor" cols="30" rows="20" class="form-control">
                                @isset($feature->description)
{!! $feature->description !!}
@endisset
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <x-adminetic-edit-add-button :model="$feature ?? null" name="feature" />
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                @livewire('admin.category.quick-category', ['model' => 'Service', 'category_id' => $feature->category_id ?? null, 'attribute' => 'category_id'])
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Service Image
            </div>
            <div class="card-body shadow-lg p-3">
                @livewire('admin.system.upload-image', ['model' => $feature ?? null, 'attribute' => 'image'])
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Service Icon Image
            </div>
            <div class="card-body shadow-lg p-3">
                @livewire('admin.system.upload-image', ['model' => $feature ?? null, 'attribute' => 'icon_image'])
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-lg-6">
                        <label>{{ label('features', 'active') }}</label> <br>
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" name="active" id="active" value="1"
                            {{ isset($feature->active) ? ($feature->active ? 'checked' : '') : 'checked' }}>
                    </div>
                    <div class="col-lg-6">
                        <label>{{ label('features', 'featured') }}</label> <br>
                        <input type="hidden" name="featured" value="0">
                        <input type="checkbox" name="featured" id="featured" value="1"
                            {{ isset($feature->featured) ? ($feature->featured ? 'checked' : '') : '' }}>
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <label for="icon">{{ label('features', 'icon') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i id="showIcon" class="fa fa-concierge-bell"></i></span>
                        <button type="button" class="btn btn-primary" id="iconPicker" data-iconpicker-input="#icon"
                            data-iconpicker-preview="#showIcon">Select
                            Icon</button>
                        <input type="hidden" name="icon" id="icon"
                            value="{{ $feature->icon ?? (old('icon') ?? 'fa fa-concierge-bell') }}">
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <label for="color">{{ label('features', 'color') }}</label>
                    <input type="color" name="color" id="color" value="{{ $feature->color ?? old('color') }}">
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="mt-4">
                    <label for="meta_name">{{ label('features', 'meta_name', 'Meta Name') }}</label>
                    <div class="input-group">
                        <input type="text" name="meta_name" id="meta_name" class="form-control"
                            value="{{ $feature->meta_name ?? old('meta_name') }}" placeholder="Meta Name">
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <label
                        for="meta_description">{{ label('features', 'meta_description', 'Meta Description') }}</label>
                    <textarea name="meta_description" id="meta_description" cols="30" rows="10" class="form-control">{{ $feature->meta_description ?? old('meta_description') }}</textarea>
                </div>
                <br>
                <div class="mt-4">
                    <label for="meta_keywords">{{ label('features', 'meta_keywords', 'Meta Keywords') }}</label>
                    <div class="input-group">
                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                            value="{{ $feature->meta_keywords ?? old('meta_keywords') }}"
                            placeholder="Meta Keywords">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
