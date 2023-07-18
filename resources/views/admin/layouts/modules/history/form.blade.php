<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="title">{{ label('histories', 'title') }}</label>
                        <div class="input-group">
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $history->title ?? old('title') }}" placeholder="Title">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3">
                        <label for="description">{{ label('histories', 'description') }}</label>
                        <div class="input-group">
                            <textarea name="description" cols="30" rows="5" class="form-control">
                                @isset($history->description)
                                    {!! $history->description !!}
                                @endisset
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <x-adminetic-edit-add-button :model="$history ?? null" name="History" />
    </div>
    <div class="col-lg-4">

        <div class="card">
            <div class="card-header">
                Image
            </div>
            <div class="card-body shadow-lg p-3">
                @livewire('admin.system.upload-image', ['model' => $history ?? null, 'attribute' => 'image'])
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <label>{{ label('histories', 'date') }}</label> <br>
                <input type="date" name="date" class="form-control" value="{{ $history->date ?? old('date') }}">
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-lg-6">
                        <label>{{ label('histories', 'active') }}</label> <br>
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" name="active" id="active" value="1"
                            {{ isset($history->active) ? ($history->active ? 'checked' : '') : 'checked' }}>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="mt-4">
                    <label for="meta_name">{{ label('histories', 'meta_name', 'Meta Name') }}</label>
                    <div class="input-group">
                        <input type="text" name="meta_name" id="meta_name" class="form-control"
                            value="{{ $history->meta_name ?? old('meta_name') }}" placeholder="Meta Name">
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <label
                        for="meta_description">{{ label('histories', 'meta_description', 'Meta Description') }}</label>
                    <textarea name="meta_description" id="meta_description" cols="30" rows="10" class="form-control">{{ $history->meta_description ?? old('meta_description') }}</textarea>
                </div>
                <br>
                <div class="mt-4">
                    <label for="meta_keywords">{{ label('histories', 'meta_keywords', 'Meta Keywords') }}</label>
                    <div class="input-group">
                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                            value="{{ $history->meta_keywords ?? old('meta_keywords') }}"
                            placeholder="Meta Keywords">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
