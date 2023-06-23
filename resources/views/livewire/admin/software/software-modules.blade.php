<div>
    <div class="card">
        <div class="card-header" style="position: sticky;top: 0;background-color: white;z-index: 2;">
            <div class="d-flex justify-content-between">
                <b>Modules</b>
                <button type="button" class="btn btn-success btn-air-success" wire:click="addModule"><i
                        class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="card-body shadow-lg p-3">
            @if (count($modules ?? []) > 0)
                @foreach ($modules as $index => $module)
                    <div class="row">
                        <div class="col-lg-9">
                            <label>Name</label> <br>
                            <input type="text" name="data[modules][{{ $index }}][name]" class="form-control"
                                wire:model="modules.{{ $index }}.name">
                        </div>
                        <div class="col-lg-3">
                            <button class="btn btn-danger btn-air-danger" type="button"
                                wire:click="removeModule({{ $index }})"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-3">
                            <label>Color</label> <br>
                            <input type="color" name="data[modules][{{ $index }}][color]" class="form-control"
                                wire:model="modules.{{ $index }}.color">
                        </div>
                        <div class="col-lg-9">
                            <label>Icon</label> <br>
                            <div class="input-group">
                                <span class="input-group-text">
                                    @if (!is_null($modules[$index]['icon']))
                                        <i class="{{ $modules[$index]['icon'] }}"></i>
                                    @else
                                        Icon
                                    @endif
                                </span>
                                <input type="text" name="data[modules][{{ $index }}][icon]"
                                    class="form-control" wire:model="modules.{{ $index }}.icon">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <textarea name="data[modules][{{ $index }}][description]" wire:model="modules.{{ $index }}.description"
                        cols="30" rows="10" class="form-control"></textarea>

                    <hr>
                @endforeach
            @endif
        </div>
    </div>
</div>
