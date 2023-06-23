<div>
    <div class="row">
        <div class="col-8">Name</div>
        <div class="col-2">Included</div>
        <div class="col-2">
            <button class="btn btn-success btn-air-success" type="button" wire:click="addFeature"><i
                    class="fa fa-plus"></i></button>
        </div>
    </div>
    <hr>
    @if (count($features ?? []) > 0)
        @foreach ($features as $index => $feature)
            <div class="row">
                <div class="col-8">
                    <input type="text" name="data[features][{{ $index }}][name]" class="form-control"
                        value="{{ $feature['name'] ?? old('data[features][' . $index . '][name]') }}" required>
                </div>
                <div class="col-2">
                    <input type="hidden" name="data[features][{{ $index }}][included]" value="0">
                    <input type="checkbox" name="data[features][{{ $index }}][included]" value="1"
                        {{ $feature['included'] ?? false ? 'checked' : '' }}>
                </div>
                <div class="col-2">
                    <button class="btn btn-danger btn-air-danger" type="button"
                        wire:click="removeFeature({{ $index }})"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        @endforeach
    @endif
</div>
