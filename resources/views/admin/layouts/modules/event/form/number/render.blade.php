@isset($form)
<div class="col-lg-{{$form['width'] ?? 12}} mt-3 mb-3">
    <label>{{$form['placeholder'] ?? $form['name'] ?? 'Number Here'}}</label>
    <div class="input-group single-form">
        <input wire:model.defer="information.{{$form['name'] ?? 'number'}}" type="number"
            name="{{$form['name'] ?? 'number'}}" class="form-control" value="{{$form['value'] ?? null}}"
            placeholder="{{$form['placeholder'] ?? $form['name'] ?? 'Number Here' }}" {{$form['required'] ? 'required'
            : '' }}>
    </div>
</div>
@endisset