<div class="row">
    <div class="col-lg-10">
        <label for="name">Template Name</label>
        <div class="input-group">
            <input type="text" name="name" id="name" class="form-control" value="{{ $template->name ?? old('name') }}"
                placeholder="Template Name">
        </div>
    </div>
    <div class="col-lg-2">
        <label>Active ?</label> <br>
        <label class="switch">
            <input type="hidden" name="active" value="0">
            <input type="checkbox" value="1" name="active"
                {{ isset($template->active) ? ($template->active ? 'checked' : '') : 'checked' }}><span
                class="switch-state"></span>
        </label>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <label for="template">Template</label>
        <textarea name="template" id="heavytexteditor">
                @isset($template->template)
                                {!! $template->template !!}
                @endisset
            </textarea>
    </div>
</div>
<x-adminetic-edit-add-button :model="$template ?? null" name="Template" />