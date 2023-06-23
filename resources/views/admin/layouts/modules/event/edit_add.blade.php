<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body shadow-lg p-2">
                <div class="row">
                    <div class="col-12">
                        <label for="name">Event Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $event->name ?? old('name') }}" placeholder="Event Name">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label for="excerpt">Short Description</label>
                        <textarea name="excerpt" id="excerpt" cols="30" rows="10" class="form-control">{{ $event->excerpt ?? '' }}</textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label for="description">Event Description</label>
                        <textarea name="description" id="heavytexteditor">
                            @isset($event)
{!! $event->description !!}
@endisset
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
        @livewire('admin.event.ticket-plan', ['event' => $event ?? null])
        <div class="card">
            <div class="card-body shadow-lg p-2">
                @livewire('admin.event.invited-guests', ['event' => $event ?? null])
            </div>
        </div>
        <hr>
        <x-adminetic-edit-add-button :model="$event ?? null" name="Event" />
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body shadow-lg p-2">
                @livewire('admin.category.quick-category', ['model' => 'Event', 'category_id' => $event->category_id ?? null, 'attribute' => 'category_id'])
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-2">
                <div class="row">
                    <div class="col-12">
                        <label>Active</label> <br>
                        <label class="switch">
                            <input type="hidden" name="active" value="0">
                            <input type="checkbox" name="active" value="1"
                                {{ isset($event->active) ? ($event->active ? 'checked' : '') : 'checked' }}><span
                                class="switch-state"></span>
                        </label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label>Featured ?</label> <br>
                        <label class="switch">
                            <input type="hidden" name="featured" value="0">
                            <input type="checkbox" name="featured" value="1"
                                {{ isset($event->featured) ? ($event->featured ? 'checked' : '') : '' }}><span
                                class="switch-state"></span>
                        </label>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-2">
                <div class="row">
                    <div class="col-12" id="interval_body">
                        <label for="interval">Event Interval <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            <input type="hidden" name="start_date" id="start_date"
                                value="{{ $event->start_date ?? null }}">
                            <input type="hidden" name="end_date" id="end_date" value="{{ $event->end_date ?? null }}">
                            <input type="text" name="interval" id="interval" class="form-control"
                                value="{{ $event->interval ?? old('interval') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-2">
                <div class="row">
                    <div class="col-12">
                        <label for="phone">Event Manager Phone</label>
                        <select name="phone[]" class="tag" id="phone" multiple>
                            @isset($event->phone)
                                @foreach ($event->phone as $phone)
                                    <option value="{{ $phone }}" selected>{{ $phone }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label for="email">Event Manager Email</label>
                        <select name="email[]" class="tag" id="email" multiple>
                            @isset($event->email)
                                @foreach ($event->email as $email)
                                    <option value="{{ $email }}" selected>{{ $email }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" class="form-control"
                            value="{{ $event->location ?? old('location') }}" placeholder="Event Location">
                    </div>
                    <br>
                    <div class="col-12">
                        <div class="input-group">
                            <span class="input-group-text">Location: </span>
                            <input type="text" id="location" class="form-control" />
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Lat: </span>
                            <input type="text" id="lat" name="latitude" class="form-control" />
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Long: </span>
                            <input type="text" id="lng" name="longitude" class="form-control" />
                        </div>
                        <div id="us2" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-2">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="image">Event Thumbnail (3 MB)</label> <br>
                        <input type="file" name="image" id="image" accept="image/*"
                            onchange="readURL(this);">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        @if (isset($event))
                            @if (!is_null($event->getRawOriginal('image')))
                                <br>
                                <img src="{{ $event->image }}" alt="{{ $event->name ?? '' }}" class="img-fluid"
                                    id="event_image">
                            @endif
                        @endif
                        <img src="" id="event_image_placeholder" class="img-fluid">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <label for="video">Event Video</label> <br>
                        <input type="text" name="video" id="video" class="form-control"
                            value="{{ $event->video ?? old('video') }}" placeholder="Video URL">
                    </div>
                </div>
            </div>
        </div>
        @livewire('admin.event.event-clients', ['event' => $event ?? null])
        <div class="card">
            <div class="card-body shadow-lg p-2">
                <div class="row">
                    <div class="col-12">
                        <label for="meta_name">Meta Name</label>
                        <input type="text" name="meta_name" id="meta_name" class="form-control"
                            value="{{ $event->meta_name ?? old('meta_name') }}" placeholder="Meta Name">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label for="meta_description">Meta Description</label>
                        <textarea name="meta_description" class="form-control" id="meta_description" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label for="meta_keywords">Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                            value="{{ $event->meta_keywords ?? old('meta_keywords') }}" placeholder="Meta Keywords">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
