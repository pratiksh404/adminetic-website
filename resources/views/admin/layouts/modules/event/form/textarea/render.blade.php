@isset($form)
<div class="col-lg-{{$form['width'] ?? 12}} mt-3 mb-3">
    <label>{{$form['placeholder'] ?? $form['name'] ?? 'Text Here'}}</label>
    <div class="input-group single-form">
        <textarea wire:model.defer="information.{{$form['name'] ?? 'textarea'}}" name="{{$form['name'] ?? 'textarea'}}"
            class="form-control" {{$form['required'] ? 'required' : '' }}>{{$form['value'] ?? null}}</textarea>
    </div>
</div>
@endisset