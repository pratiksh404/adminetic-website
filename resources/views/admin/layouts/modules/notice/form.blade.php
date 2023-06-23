<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="name">{{ label('notices', 'name') }}</label>
                        <div class="input-group">
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $notice->name ?? old('name') }}" placeholder="notice Name">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="excerpt">{{ label('notices', 'excerpt') }}</label>
                        <div class="input-group">
                            <textarea name="excerpt" id="excerpt" cols="30" rows="20" class="form-control">{{ $notice->excerpt ?? old('excerpt') }}</textarea>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="excerpt">{{ label('notices', 'description') }}</label>
                        <div class="input-group">
                            <textarea name="description" id="heavytexteditor" cols="30" rows="20" class="form-control">
                                @isset($notice->description)
{!! $notice->description !!}
@endisset
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <x-adminetic-edit-add-button :model="$notice ?? null" name="notice" />
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                @livewire('admin.category.quick-category', ['model' => 'Service', 'category_id' => $notice->category_id ?? null, 'attribute' => 'category_id'])
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Service Image
            </div>
            <div class="card-body shadow-lg p-3">
                @livewire('admin.system.upload-image', ['model' => $notice ?? null, 'attribute' => 'image'])
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Service Icon Image
            </div>
            <div class="card-body shadow-lg p-3">
                @livewire('admin.system.upload-image', ['model' => $notice ?? null, 'attribute' => 'icon_image'])
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-lg-6">
                        <label>{{ label('notices', 'active') }}</label> <br>
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" name="active" id="active" value="1"
                            {{ isset($notice->active) ? ($notice->active ? 'checked' : '') : 'checked' }}>
                    </div>
                    <div class="col-lg-6">
                        <label>{{ label('notices', 'popup') }}</label> <br>
                        <input type="hidden" name="popup" value="0">
                        <input type="checkbox" name="popup" id="popup" value="1"
                            {{ isset($notice->popup) ? ($notice->popup ? 'checked' : '') : '' }}>
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <label for="expire">{{ label('notices', 'expire', 'Expire Date') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-clock"></i></span>
                        <input type="text" name="expire" id="expire" class="form-control"
                            value="{{ $notice->expire ?? old('expire') }}">
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <label for="icon">{{ label('notices', 'icon') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i id="showIcon" class="fa fa-concierge-bell"></i></span>
                        <button type="button" class="btn btn-primary" id="iconPicker" data-iconpicker-input="#icon"
                            data-iconpicker-preview="#showIcon">Select
                            Icon</button>
                        <input type="hidden" name="icon" id="icon"
                            value="{{ $notice->icon ?? (old('icon') ?? 'fa fa-concierge-bell') }}">
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <label for="color">{{ label('notices', 'color') }}</label>
                    <input type="color" name="color" id="color" value="{{ $notice->color ?? old('color') }}">
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="mt-4">
                    <label for="meta_name">{{ label('notices', 'meta_name', 'Meta Name') }}</label>
                    <div class="input-group">
                        <input type="text" name="meta_name" id="meta_name" class="form-control"
                            value="{{ $notice->meta_name ?? old('meta_name') }}" placeholder="Meta Name">
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <label
                        for="meta_description">{{ label('notices', 'meta_description', 'Meta Description') }}</label>
                    <textarea name="meta_description" id="meta_description" cols="30" rows="10" class="form-control">{{ $notice->meta_description ?? old('meta_description') }}</textarea>
                </div>
                <br>
                <div class="mt-4">
                    <label for="meta_keywords">{{ label('notices', 'meta_keywords', 'Meta Keywords') }}</label>
                    <div class="input-group">
                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                            value="{{ $notice->meta_keywords ?? old('meta_keywords') }}" placeholder="Meta Keywords">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
