<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-2">
                            <label for="name">Event Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{$event->name ?? old('name')}}" placeholder="Event Name">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-2">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="heavytexteditor">
                                @isset($event->description)
                                    {!! $event->description !!}
                                @endisset
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-adminetic-edit-add-button :model="$event ?? null" name="Event" />
    </div>
    <div class="col-lg-4" id="event_date_section">
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-2">
                            <label for="single_day">Event Type</label>
                            <div class="input-group">
                                <select name="single_day" id="single_day" class="form-control" style="width: 100%">
                                    <option disabled selected>Event Type ... </option>
                                    <option value="1"
                                        {{isset($event->single_day) ? ($event->single_day ? 'selected' : '') : ''}}>
                                        Single Day</option>
                                    <option value="0"
                                        {{isset($event->single_day) ? ($event->single_day ? '' : 'selected') : ''}}>
                                        Multiple Days</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row" id="single_day_section" style="display: none">
                    <div class="col-lg-12">
                        <label for="event_date">Event Date <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="event_date" id="event_date" class="form-control"
                                value="{{$event->event_date ?? old('event_date')}}">
                        </div>
                    </div>
                </div>
                <div class="row" id="multiple_day_section" style="display: none">
                    <div class="col-lg-12">
                        <label for="interval">Event Interval <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="hidden" name="start_date" id="start_date">
                            <input type="hidden" name="end_date" id="end_date">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="interval" id="interval" class="form-control"
                                value="{{$event->interval ?? old('interval')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-2">
                            <label for="notice">Notice</label>
                            <textarea name="notice" id="notice"
                                class="form-control">{{$event->notice ?? old('notice')}}</textarea>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-2">
                            <label for="image">Image</label>
                            <div class="input-group">
                                <input type="file" name="image" accept="image/*" onchange="readURL(this);">
                            </div>
                            <br>
                            @if (isset($event->image))
                            <img src="{{asset('storage/' . $event->image)}}" alt="{{$event->name}}" id="image"
                                class="img-fluid">
                            @endif
                            <img src="" id="image_plcaeholder" class="img-fluid" width="100%">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-2">
                            <label for="gallery_id">Attach Gallery</label>
                            <div class="input-group">
                                <select name="gallery_id" id="gallery_id" class="select2" style="width: 100%">
                                    <option selected disabled>Select Gallery ... </option>
                                    @isset($galleries)
                                    @foreach ($galleries as $gallery)
                                    <option value="{{$gallery->id}}"
                                        {{isset($event->gallery_id) ? ($event->gallery_id == $gallery->id ? 'selected' : '') : ''}}>
                                        {{$gallery->name}}</option>
                                    @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
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
                                    value="{{$event->meta_name ?? old('meta_name')}}" placeholder="SEO Title">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="meta_description">Meta Description</label>
                            <div class="input-group">
                                <textarea name="meta_description" id="meta_description"
                                    style="width:100%">@isset($event->meta_description){{$event->meta_description}}@endisset</textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="meta_keywords">Meta Keywords</label>
                            <div class="input-group">
                                <select name="meta_keywords[]" id="meta_keywords" class="tags form-control" multiple>
                                    @isset($event->meta_keywords)
                                    @foreach ($event->meta_keywords as $meta_keyword)
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