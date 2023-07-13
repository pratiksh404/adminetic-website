<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="title">{{ label('sliders', 'title') }}</label>
                        <div class="input-group">
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $slider->title ?? old('title') }}" placeholder="slider title">
                        </div>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="excerpt">{{ label('sliders', 'text') }}</label>
                        <div class="input-group">
                            <textarea name="text" id="heavytexteditor" cols="30" rows="5" class="form-control">
                                @isset($slider->text)
{!! $slider->text !!}
@endisset
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <x-adminetic-edit-add-button :model="$slider ?? null" name="Slider" />
    </div>
    <div class="col-lg-4">

        <div class="card">
            <div class="card-header">
                Slider Image
            </div>
            <div class="card-body shadow-lg p-3">
                @livewire('admin.system.upload-image', ['model' => $slider ?? null, 'attribute' => 'image'])
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-lg-6">
                        <label>{{ label('sliders', 'active') }}</label> <br>
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" name="active" id="active" value="1"
                            {{ isset($slider->active) ? ($slider->active ? 'checked' : '') : 'checked' }}>
                    </div>
                </div>
                <br>
            </div>
        </div>

    </div>
</div>
