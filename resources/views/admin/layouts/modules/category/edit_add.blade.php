<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-2">
                            <label for="name" class="form-label">Category Name</label>
                            <div class="input-group">
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{$category->name ?? old('name')}}" placeholder="Category Name">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-2">
                            <label for="parant_id" class="form-label">Category Parent</label>
                            <div class="input-group">
                                <select name="category_id" id="category_id" class="select2" style="width: 100%">
                                    <option selected disabled>Select Parent Category ... </option>
                                    @isset($parentcategories)
                                    @foreach ($parentcategories as $parent_category)
                                    @if (!isset($parent_category->category_id))
                                    <option value="{{ $parent_category->id }}" {{isset($category->id) ? ($category->id
                                        == $parent_category->id ? 'disabled' : '') : ''}}
                                        {{isset($category->category_id) ? ($category->category_id ==
                                        $parent_category->id ? 'selected' : '') : ''}}>
                                        {{ $parent_category->name }}</option>
                                    @isset($parent_category->childrenCategories)
                                    @php
                                    $parent_loop_index = $loop->index + 1;
                                    @endphp
                                    @foreach ($parent_category->childrenCategories as $child)
                                    @include('website::admin.layouts.modules.category.option_child_category', ['child'
                                    =>
                                    $child,'parent_loop_index'
                                    => $parent_loop_index])
                                    @endforeach

                                    @endisset
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
                        <label for="description">Description</label>
                        <textarea name="description" id="heavytexteditor" cols="30" rows="10">
                            @isset($category->description)
                                {!! $category->description !!}
                            @endisset
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-2">
                            <label for="model">Model</label>
                            <div class="input-group">
                                <select name="model" id="model" class="select2" style="width:100%">
                                    <option selected disabled>Select Model ... </option>
                                    @foreach(array_unique(array_merge(getAllModelNames(app_path('Models')),config('website.models',[])))
                                    as $model)
                                    <option value="{{$model}}" {{isset($category->model) ? ($category->model == $model ?
                                        'selected' : '') : ''}}>
                                        {{$model}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-7">
                        <label for="active">Active</label>
                        <div class="mb-2">
                            <label class="switch">
                                <input type="hidden" name="active" value="0">
                                <input name="active" type="checkbox" value="1" id="active" {{isset($category->active) ?
                                ($category->active ? 'checked' : '') : 'checked'}}><span class="switch-state"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="mb-2">
                            <label for="color">Color</label>
                            <div class="input-group">
                                <input name="color" class="form-control form-control-color" type="color"
                                    value="{{$category->color ?? old('color') ?? '#563d7c'}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-2">
                            <label for="icon">Icon</label>
                            <div class="input-group">
                                <span class="input-group-text"><i id="showIcon" class="fa fa-concierge-bell"></i></span>
                                <button type="button" class="btn btn-primary" id="iconPicker"
                                    data-iconpicker-input="#icon" data-iconpicker-preview="#showIcon">Select
                                    Icon</button>
                                <input type="hidden" name="icon" id="icon"
                                    value="{{$service->icon ?? old('icon') ?? 'fa fa-concierge-bell'}}">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="image">Category Image</label>
                                <input type="file" name="image" id="image" accept="image/*" onchange="readURL(this);">
                            </div>
                            <div class="col-lg-12">
                                @if (isset($category->image))
                                <img src="{{asset($category->thumbnail('image','small'))}}" alt="{{$category->name}}">
                                @endif
                                <img src="" id="category_image_plcaeholder" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-12">
                        <span class="text-bold text-center">SEO</span>
                        <div class="mb-2">
                            <label for="meta_name">Meta Name</label>
                            <div class="input-group">
                                <input type="text" name="meta_name" id="meta_name" class="form-control"
                                    value="{{$category->meta_name ?? old('meta_name')}}" placeholder="Meta Name">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-lg-12">
                        <div class="mb-2">
                            <label for="meta_name">Meta Description</label>
                            <div class="input-group">
                                <textarea name="meta_description" id="meta_description"
                                    class="form-control">{{$category->meta_description ?? ''}}</textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-lg-12">
                        <div class="mb-2">
                            <label for="meta_name">Meta Keywords</label>
                            <div class="input-group">
                                <select name="meta_keywords[]" id="meta_keywords" class="meta_keywords"
                                    style="width: 100%" multiple>
                                    @isset($category->meta_keywords)
                                    @foreach ($category->meta_keywords as $keyword)
                                    <option value="{{$keyword}}" selected>{{$keyword}}</option>
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <x-adminetic-edit-add-button :model="$category ?? null" name="Category" />
                </div>
            </div>
        </div>
    </div>
</div>