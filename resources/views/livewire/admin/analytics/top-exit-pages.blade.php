<div>
    <b class="text-center">Top Exiting Page</b>
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
        <table class="table table-hover table-striped table-responsive">
            <thead>
                <tr>
                    <th>URL</th>
                    <th>Exits</th>
                    <th>Views</th>
                </tr>
            </thead>
            <tbody>
                @isset($top_exit_pages)
                @if (count($top_exit_pages) > 0)
                @foreach ($top_exit_pages as $top_exit_page)
                @if ($loop->index <= 10) <tr>
                    <td>{{$top_exit_page[0] ?? 'N/A'}}</td>
                    <td>{{$top_exit_page[1] ?? 'N/A'}}</td>
                    <td>{{$top_exit_page[2] ?? 'N/A'}}</td>
                    </tr>
                    @endif
                    @endforeach
                    @endif
                    @endisset
            </tbody>
        </table>
    </div>
</div>