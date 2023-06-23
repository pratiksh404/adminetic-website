<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body shadow-lg">
                <div class="mt-4">
                    <label for="name">{{ label('clients', 'name') }}</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ $client->name ?? old('name') }}" placeholder="Client Name">
                </div>
                <div class="mt-4">
                    <label for="url">{{ label('clients', 'url') }}</label>
                    <input type="text" name="url" id="url" class="form-control"
                        value="{{ $client->url ?? old('url') }}" placeholder="Client Redirect Link">
                </div>
                <div class="mt-4">
                    <label for="description">{{ label('clients', 'description') }}</label>
                    <textarea name="description" id="heavytexteditor" cols="30" rows="10">
                        @isset($client->description)
{!! $client->description !!}
@endisset
                    </textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body shadow-lg">
                <div class="mt-4">
                    <label>{{ label('features', 'featured') }}</label> <br>
                    <input type="hidden" name="featured" value="0">
                    <input type="checkbox" name="featured" id="featured" value="1"
                        {{ isset($client->featured) ? ($client->featured ? 'checked' : '') : '' }}>
                </div>
                <div class="mt-4">
                    @livewire('admin.system.upload-image', ['model' => $client ?? null, 'attribute' => 'image'])
                </div>
            </div>
        </div>
        <hr>
        <x-adminetic-edit-add-button :model="$client ?? null" name="Client" />
    </div>
</div>
