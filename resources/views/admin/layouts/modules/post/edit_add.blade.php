<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="name">Post Title</label>
                            <div class="input-group">
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $post->name ?? old('name') }}" placeholder="Post Title">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="excerpt">Post Excerpt</label>
                            <div class="input-group">
                                <textarea name="excerpt" id="excerpt"
                                    class="excerpt form-control">@isset($post->excerpt){{ $post->excerpt }}@endisset</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-lg-12">
                        <select id="template" class="select2" style="width: 100%">
                            <option selected disabled>Select Template ... </option>
                            @isset($templates)
                            @foreach ($templates as $template)
                            <option value="{{ $template->id }}">{{ $template->name }}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <textarea name="body" id="heavytexteditor" class="body form-control">
                                           @isset($post->body)
                                            {!! $post->body !!}        
                                           @endisset
                                           </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-adminetic-edit-add-button :model="$post ?? null" name="Post" />
    </div>
    <div class="col-lg-4" style="height:80vh;overflow-y:auto">
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="author">Author</label>
                            <div class="input-group">
                                <input type="hidden" name="author_id"
                                    value="{{ $post->author_id ?? auth()->user()->id }}">
                                <input type="text" name="author" id="author" class="form-control"
                                    value="{{ $post->author->name ?? auth()->user()->name }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @livewire('admin.category.quick-category', ['model' => 'Category','category_id' =>
                            $post->category_id ?? null])
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="type">Post Type</label>
                            <select name="type" id="type" class="select2" style="width: 100%">

                                @foreach (config('website.post_type',array(
                                [
                                'id' => 1,
                                'name' => 'General Post'
                                ],
                                [
                                'id' => 2,
                                'name' => 'Video Post'
                                ],
                                [
                                'id' => 3,
                                'name' => 'Audio Post'
                                ]
                                )) as $type)
                                @if (count($type) > 0)
                                @if (!is_null($type['id']) && !is_null($type['name']))
                                <option value="{{$type['id']}}" {{isset($post->type) ? ($post->type == $type['id'] ?
                                    'selected' : '') : ''}}>
                                    {{$type['name']}}</option>
                                @endif
                                @endif
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="image">Post Video</label> <br>
                                    <input type="text" name="video" id="video" class="form-control"
                                        value="{{ $post->video ?? old('video') }}" placeholder="Video URL">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="image">Post Audio</label> <br>
                                    <input type="text" name="audio" id="audio" class="form-control"
                                        value="{{ $post->audio ?? old('audio') }}" placeholder="Audio URL">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="image">Post Image</label> <br>
                                    <input type="file" name="image" id="image" accept="image/*"
                                        onchange="readURL(this);">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12 d-flex justify-content-center">
                                    @if (isset($post->image))
                                    <br>
                                    <img src="{{ asset($post->thumbnail('image', 'small')) }}"
                                        alt="{{ $post->name ?? '' }}" class="img-fluid" id="post_image">
                                    @endif
                                    <img src="" id="post_image_plcaeholder" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="status">Status</label>
                            <div class="input-group">
                                <select name="status" id="status" class="select2 form-control">
                                    <option selected disabled>Select Status ..</option>
                                    <option value="1" {{ isset($post) ? ($post->status == 'Draft' ? 'selected' : '') :
                                        '' }}>
                                        Draft
                                    </option>
                                    <option value="2" {{ isset($post) ? ($post->status == 'Pending' ? 'selected' : '') :
                                        'selected' }}>
                                        Pending</option>
                                    @hasRole('admin|moderator')
                                    <option value="3" {{ isset($post) ? ($post->status == 'Published' ? 'selected' : '')
                                        : '' }}>
                                        Published</option>
                                    @endhasRole
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Featured ?</label> <br>
                            <label class="switch">
                                <input type="hidden" name="featured" value="0">
                                <input type="checkbox" value="1" {{ isset($post->featured) ? ($post->featured ?
                                'checked' : '') : '' }}><span class="switch-state"></span>
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label>Breaking News ?</label> <br>
                            <label class="switch">
                                <input type="hidden" name="breaking_news" value="0">
                                <input type="checkbox" value="1" {{ isset($post->breaking_news) ? ($post->breaking_news
                                ? 'checked' : '') : '' }}><span class="switch-state"></span>
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label>Hot News ?</label> <br>
                            <label class="switch">
                                <input type="hidden" name="hot_news" value="0">
                                <input type="checkbox" value="1" {{ isset($post->hot_news) ? ($post->hot_news ?
                                'checked' : '') : '' }}><span class="switch-state"></span>
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="priority">Priority ?</label> <br>
                            <input type="number" name="priority" id="priority" class="touchspin"
                                value="{{ $post->priority ?? (old('priority') ?? 1) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="tags">Tags</label>
                            <select name="tags[]" id="tags" class="tags form-control" multiple>
                                @isset($tags)
                                @foreach ($tags as $tag)
                                <option value="{{ $tag }}">{{ $tag }}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                    </div>
                    @if (isset($remove_tags))
                    <hr>
                    <div class="row">
                        <label>Remove Tags ?</label>
                        <div class="col-lg-12">
                            <ul>
                                @foreach ($remove_tags as $remove_tag)
                                <li>
                                    <input type="checkbox" name="remove_tags[]" id="remove_tags"
                                        value="{{ $remove_tag }}">
                                    <span class="text-muted">{{ $remove_tag }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <br>
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="card-body">
                    <div class="row">
                        <b>SEO</b>
                        <div class="col-lg-12">
                            <label for="seo_name">SEO Title</label>
                            <div class="input-group">
                                <input type="text" name="seo_name" id="seo_name" class="form-control"
                                    value="{{ $post->seo_name ?? old('seo_name') }}" placeholder="SEO Title">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="meta_description">Meta Description</label>
                            <div class="input-group">
                                <textarea name="meta_description" id="meta_description"
                                    style="width:100%">@isset($post->meta_description){{ $post->meta_description }}@endisset</textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="meta_keywords">Meta Keywords</label>
                            <div class="input-group">
                                <select name="meta_keywords[]" id="meta_keywords" class="tags form-control" multiple>
                                    @isset($post->meta_keywords)
                                    @foreach ($post->meta_keywords as $meta_keyword)
                                    <option value="{{ $meta_keyword }}" selected>{{ $meta_keyword }}
                                    </option>
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