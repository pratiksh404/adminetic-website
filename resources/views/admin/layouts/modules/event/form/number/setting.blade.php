@isset($form)
<div class="row">
    <div class="col-12">
        <label>Name</label>
        <input type="text" wire:model="forms.inputs.{{$index}}.setting.name" class="form-control">
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <label>Placeholder</label>
        <input type="text" wire:model="forms.inputs.{{$index}}.setting.placeholder" class="form-control">
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-6">
        <label>Value</label>
        <input type="text" wire:model="forms.inputs.{{$index}}.setting.value" class="form-control">
    </div>
    <div class="col-lg-6">
        <label>Required</label> <br>
        <label class="switch">
            <input type="checkbox" value="1" wire:model="forms.inputs.{{$index}}.setting.required"><span
                class="switch-state"></span>
        </label>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <label>Width</label>
        <select class="form-control" wire:model="forms.inputs.{{$index}}.setting.width">
            @foreach (range(1,12) as $width)
            <option value="{{$width}}">{{$width}}</option>
            @endforeach
        </select>
    </div>
</div>
@endisset