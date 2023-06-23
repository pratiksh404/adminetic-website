<div>
    <div class="row">
        <div class="col-1">S.N</div>
        <div class="col-3">Subject</div>
        <div class="col-7">Information</div>
        <div class="col-1">
            <button type="button" class="btn text-white btn-success btn-air-success btn-sm"
                wire:click.prevent="add({{ $i }})"><i class="fa fa-plus"></i></button>
        </div>
    </div>
    <hr>
    @if ($i != 0)
        @foreach (range(1, $i) as $key)
            @if (!in_array($key, $removes))
                <div class="row">
                    <div class="col-1">{{ $key }}</div>
                    <div class="col-3">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter subject"
                                name="summary[{{ $key }}][subject]"
                                wire:model.defer="summary.{{ $key }}.subject">
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="form-group">
                            <textarea name="summary[{{ $key }}][information]" wire:model.defer="summary.{{ $key }}.information"
                                class="form-control">{{ $summary[$key]['information'] ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{ $key }})"><i
                                class="fa fa-trash"></i></button>
                    </div>
                </div>
                <br>
            @endif
        @endforeach
    @endif
</div>
