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
    <div class="col-12">
        <label>Width</label>
        <select class="form-control" wire:model="forms.inputs.{{$index}}.setting.width">
            @foreach (range(1,12) as $width)
            <option value="{{$width}}">{{$width}}</option>
            @endforeach
        </select>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <label>Required</label> <br>
        <label class="switch">
            <input type="checkbox" value="1" wire:model="forms.inputs.{{$index}}.setting.required"><span
                class="switch-state"></span>
        </label>
    </div>
</div>
<br>
@isset($form['options'])
<br>
<div class="row">
    <div class="col-12">
        <label>Options</label>
        <hr>
        <div class="row">
            <div class="col-4">Value</div>
            <div class="col-7">Name</div>
            <div class="col-1"><button class="btn btn-primary btn-air-primary btn-sm p-2"
                    wire:click="addOption({{$index}})">+</button>
            </div>
        </div>
        <br>
        @foreach ($form['options'] as $option_index => $option)
        <div class="row">
            <div class="col-4"><input type="text" class="form-control"
                    wire:model="forms.inputs.{{$index}}.setting.options.{{$option_index}}.value">
            </div>
            <div class="col-7"><input type="text" class="form-control"
                    wire:model="forms.inputs.{{$index}}.setting.options.{{$option_index}}.name">
            </div>
            <div class="col-1"><button class="btn btn-danger btn-air-danger btn-sm p-2"
                    wire:click="delete_option({{$index}},{{$option_index}})"><i class="fa fa-trash"></i></button>
            </div>
        </div>
        <br>
        @endforeach
    </div>
</div>
@endisset
@endisset