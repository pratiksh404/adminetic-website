@isset($form)
<div class="col-lg-{{$form['width'] ?? 12}} mt-3 mb-3">
    <label>{{$form['placeholder'] ?? $form['name'] ?? 'Select Here'}}</label>
    <br>
    @isset($form['options'])
    @foreach ($form['options'] as $option)
    <input wire:model.defer="information.{{$form['name'] ?? 'radio'}}" type="radio" name="{{$form['name'] ?? 'radio'}}"
        value="{{$option['value']}}" {{$form['required'] ? 'required' : '' }}>{{$option['name']}}</input>
    <br>
    @endforeach
    @endisset
</div>
@endisset