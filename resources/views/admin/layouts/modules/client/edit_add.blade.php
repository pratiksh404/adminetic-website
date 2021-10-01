<div class="row">
    <div class="col-lg-6">
        <label for="name">Client Name <span class="text-danger">*</span></label>
        <input type="text" name="name" id="name" class="form-control" value="{{$client->name ?? old('client')}}"
            placeholder="Client Name">
    </div>
    <div class="col-lg-6">
        <label for="url">URL</label>
        <input type="text" name="url" id="url" class="form-control" value="{{$client->url ?? old('client')}}"
            placeholder="URL">
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-6">
        <label for="image">Client Logo <span class="text-danger">*</span></label> <br>
        <input type="file" name="image" id="image" accept="image/*" onchange="readURL(this);">
    </div>
    <div class="col-lg-6">
        @if (isset($client->image))
        <img src="{{asset('storage/' . $client->image)}}" alt="{{$client->name ?? ''}}" class="img-fluid"
            id="partner_image">
        @endif
        <img src="" id="partner_image_plcaeholder" class="img-fluid">
    </div>
</div>
<x-adminetic-edit-add-button :model="$client ?? null" name="Client" />