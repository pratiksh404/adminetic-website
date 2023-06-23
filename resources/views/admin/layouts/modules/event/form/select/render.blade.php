@isset($form)
<div class="col-lg-{{$form['width'] ?? 12}} mt-3 mb-3">
    <label>{{$form['placeholder'] ?? $form['name'] ?? 'Select Here'}}</label>
    <div class="input-group single-form">
        <select wire:model.defer="information.{{$form['name'] ?? 'checkbox'}}" name="{{$form['name'] ?? 'select'}}"
            class="form-control" value="{{$form['value'] ?? null}}" {{$form['required'] ? 'required' : '' }}>
            <option selected disabled>{{$form['placeholder'] ?? $form['name'] ?? 'Select Here' }} ..</option>
            @isset($form['options'])
            @foreach ($form['options'] as $option)
            <option value="{{$option['value']}}">{{$option['name']}}</option>
            @endforeach
            @endisset
        </select>
    </div>
</div>
@endisset