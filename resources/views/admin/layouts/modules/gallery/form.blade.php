<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-12">
                <label for="name">{{ label('galleries', 'name') }}</label>
                <input type="text" name="name" class="form-control" value="{{ $gallery->name ?? old('name') }}"
                    placeholder="Gallery Name" />
            </div>
            <div class="col-12">
                <label for="description">{{ label('galleries', 'description') }}</label>
                <textarea name="description" id="heavytexteditor" cols="30" rows="10">
        @isset($gallery->description)
{!! $gallery->description !!}
@endisset
       </textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        @livewire('admin.gallery.gallery-video', ['gallery' => $gallery ?? null])

        <div class="card">
            <div class="card-header">
                Gallery Images
            </div>
            <div class="card-body shadow-lg p-3">
                @livewire('admin.system.upload-image', ['model' => $gallery ?? null, 'attribute' => 'images', 'multiple' => true])
            </div>
        </div>
    </div>
</div>
<br>
<x-adminetic-edit-add-button :model="$gallery ?? null" name="Gallery" />
