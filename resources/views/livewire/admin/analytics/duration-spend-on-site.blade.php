<div>
    @isset($site_durations)
    @if (count($site_durations) > 0)
    <div class="input-group">
        <span class="input-group-text">Statistics in</span>
        <input type="number" wire:model.debounce.500ms="days" class="form-control" value="3" max="30">
        <span class="input-group-text">days.</span>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div wire:ignore wire:loading.flex>
                <div style="width:100%;align-items: center;justify-content: center;">
                    <div class="loader-box" style="margin:auto">
                        <div class="loader-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:loading.remove>
        @foreach ($site_durations as $site_duration)
        <br>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-body p-3 bg-primary">
                        <b>Sessions : </b> {{$site_duration[0] ?? 'N/A'}}
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-body p-3 bg-secondary">
                        <b>Durations : </b> {{\Carbon\CarbonInterval::seconds($site_duration[1] ??
                        0)->cascade()->forHumans()}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    @endisset
</div>