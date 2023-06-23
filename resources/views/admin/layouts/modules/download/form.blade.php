<div class="row">
    <div class="col-lg-10">
        <div class="mt-4">
            <label for="name">{{ label('downloads', 'name') }}</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ $downloads->name ?? old('name') }}" placeholder="Name">
        </div>
    </div>
    <div class="col-lg-2">
        <div class="mt-4">
            <label>{{ label('downloads', 'active') }}</label> <br>
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" id="active" value="1"
                {{ isset($download->active) ? ($download->active ? 'checked' : '') : 'checked' }}>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <x-media-library-attachment name="file" />
    </div>
</div>
<br>
<x-adminetic-edit-add-button :model="$download ?? null" name="Download" />
