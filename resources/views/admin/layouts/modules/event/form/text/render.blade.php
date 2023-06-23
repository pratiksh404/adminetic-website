@isset($form)
<div class="col-lg-{{$form['width'] ?? 12}} mt-3 mb-3">
    <label>{{$form['placeholder'] ?? $form['name'] ?? 'Text Here'}}</label>
    <div class="input-group single-form">
        <input wire:model.defer="information.{{$form['name'] ?? 'text'}}" type="text" name="{{$form['name'] ?? 'text'}}"
            class="form-control" value="{{$form['value'] ?? null}}"
            placeholder="{{$form['placeholder'] ?? $form['name'] ?? 'Text Here' }}" {{$form['required'] ? 'required'
            : '' }}>
    </div>
</div>
@endisset