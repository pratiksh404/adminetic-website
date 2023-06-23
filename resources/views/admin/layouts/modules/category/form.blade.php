<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="name">{{ label('categories', 'name') }}</label>
                        <div class="input-group">
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $category->name ?? old('name') }}" placeholder="Category Name">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="excerpt">{{ label('categories', 'excerpt') }}</label>
                        <div class="input-group">
                            <textarea name="excerpt" id="excerpt" cols="30" rows="40" class="form-control">{{ $category->excerpt ?? old('excerpt') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <x-adminetic-edit-add-button :model="$category ?? null" name="Category" />
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                @livewire('admin.category.quick-category', ['model' => 'Category', 'category_id' => $category->parent_id ?? null, 'label' => 'Parent Category', 'attribute' => 'parent_id'])
                <div class="mt-4">
                    <label for="model">Model</label>
                    <select name="model" id="model" class="form-control" style="width: 100%">
                        <option selected disabled>Select ...</option>
                        @foreach (getAllModelNames(app_path('Models')) as $model)
                            <option value="{{ $model }}"
                                {{ isset($category->model) ? ($category->model ? 'selected' : '') : ($model == 'Category' ? 'selected' : '') }}>
                                {{ $model }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Category Image
            </div>
            <div class="card-body shadow-lg p-3">
                @livewire('admin.system.upload-image', ['model' => $service ?? null, 'attribute' => 'image'])
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Category Icon Image
            </div>
            <div class="card-body shadow-lg p-3">
                @livewire('admin.system.upload-image', ['model' => $service ?? null, 'attribute' => 'icon_image'])
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-lg-6">
                        <label>{{ label('categories', 'active') }}</label> <br>
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" name="active" id="active" value="1"
                            {{ isset($category->active) ? ($category->active ? 'checked' : '') : 'checked' }}>
                    </div>
                    <div class="col-lg-6">
                        <label>{{ label('categories', 'featured') }}</label> <br>
                        <input type="hidden" name="featured" value="0">
                        <input type="checkbox" name="featured" id="featured" value="1"
                            {{ isset($category->featured) ? ($category->featured ? 'checked' : '') : '' }}>
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <label for="icon">{{ label('categories', 'icon') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i id="showIcon" class="fa fa-concierge-bell"></i></span>
                        <button type="button" class="btn btn-primary" id="iconPicker" data-iconpicker-input="#icon"
                            data-iconpicker-preview="#showIcon">Select
                            Icon</button>
                        <input type="hidden" name="icon" id="icon"
                            value="{{ $category->icon ?? (old('icon') ?? 'fa fa-concierge-bell') }}">
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <label for="color">{{ label('categories', 'color') }}</label>
                    <input type="color" name="color" id="color" value="{{ $category->color ?? old('color') }}">
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="mt-4">
                    <label for="meta_name">{{ label('categories', 'meta_name', 'Meta Name') }}</label>
                    <div class="input-group">
                        <input type="text" name="meta_name" id="meta_name" class="form-control"
                            value="{{ $category->meta_name ?? old('meta_name') }}" placeholder="Meta Name">
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <label
                        for="meta_description">{{ label('categories', 'meta_description', 'Meta Description') }}</label>
                    <textarea name="meta_description" id="meta_description" cols="30" rows="10" class="form-control">{{ $category->meta_description ?? old('meta_description') }}</textarea>
                </div>
                <br>
                <div class="mt-4">
                    <label for="meta_keywords">{{ label('categories', 'meta_keywords', 'Meta Keywords') }}</label>
                    <div class="input-group">
                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                            value="{{ $category->meta_keywords ?? old('meta_keywords') }}"
                            placeholder="Meta Keywords">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
