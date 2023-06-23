<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="name">{{ label('posts', 'name') }}</label>
                        <div class="input-group">
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $post->name ?? old('name') }}" placeholder="post Name">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="excerpt">{{ label('posts', 'excerpt') }}</label>
                        <div class="input-group">
                            <textarea name="excerpt" id="excerpt" cols="30" rows="20" class="form-control">{{ $post->excerpt ?? old('excerpt') }}</textarea>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="excerpt">{{ label('posts', 'description') }}</label>
                        <div class="input-group">
                            <textarea name="description" id="heavytexteditor" cols="30" rows="20" class="form-control">
                                @isset($post->description)
{!! $post->description !!}
@endisset
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <x-adminetic-edit-add-button :model="$post ?? null" name="post" />
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                @livewire('admin.category.quick-category', ['model' => 'Post', 'category_id' => $post->category_id ?? null, 'attribute' => 'category_id'])
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Post Image
            </div>
            <div class="card-body shadow-lg p-3">
                @livewire('admin.system.upload-image', ['model' => $post ?? null, 'attribute' => 'image'])
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Post Video
            </div>
            <div class="card-body shadow-lg p-3">
                @livewire('admin.gallery.gallery-video', ['post' => $post ?? null])
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="mt-4">
                    <div class="input-group">
                        <span class="input-group-text">Status</span>
                        <select name="status" id="status" class="form-control">
                            <option selected disabled>Select .. </option>
                            <option value="0"
                                {{ isset($post) ? ($post->getRawOriginal('status') == 0 ? 'selected' : '') : '' }}>Not
                                Approved</option>
                            <option value="1"
                                {{ isset($post)? ($post->getRawOriginal('status') == 1? 'selected': ''): (auth()->user()->hasRole('admin')? 'selected': '') }}>
                                Publish</option>
                            <option value="2"
                                {{ isset($post)? ($post->getRawOriginal('status') == 2? 'selected': ''): (!auth()->user()->hasRole('admin')? 'selected': '') }}>
                                Pending</option>
                            <option value="2"
                                {{ isset($post) ? ($post->getRawOriginal('status') == 3 ? 'selected' : '') : '' }}>Draft
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-lg-6">
                        <label>{{ label('posts', 'active') }}</label> <br>
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" name="active" id="active" value="1"
                            {{ isset($post->active) ? ($post->active ? 'checked' : '') : 'checked' }}>
                    </div>
                    <div class="col-lg-6">
                        <label>{{ label('posts', 'featured') }}</label> <br>
                        <input type="hidden" name="featured" value="0">
                        <input type="checkbox" name="featured" id="featured" value="1"
                            {{ isset($post->featured) ? ($post->featured ? 'checked' : '') : '' }}>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">Tags</div>
            <div class="card-body shadow-lg p-3">
                <select name="tags[]" id="tags" class="tag" multiple>
                    @if ($tags->count() > 0)
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->name }}"
                                {{ in_array($tag->id, isset($post) ? $post->tags->pluck('id')->toArray() : []) ? 'selected' : '' }}>
                                {{ $tag->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="mt-4">
                    <label for="meta_name">{{ label('posts', 'meta_name', 'Meta Name') }}</label>
                    <div class="input-group">
                        <input type="text" name="meta_name" id="meta_name" class="form-control"
                            value="{{ $post->meta_name ?? old('meta_name') }}" placeholder="Meta Name">
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <label for="meta_description">{{ label('posts', 'meta_description', 'Meta Description') }}</label>
                    <textarea name="meta_description" id="meta_description" cols="30" rows="10" class="form-control">{{ $post->meta_description ?? old('meta_description') }}</textarea>
                </div>
                <br>
                <div class="mt-4">
                    <label for="meta_keywords">{{ label('posts', 'meta_keywords', 'Meta Keywords') }}</label>
                    <div class="input-group">
                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                            value="{{ $post->meta_keywords ?? old('meta_keywords') }}" placeholder="Meta Keywords">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
