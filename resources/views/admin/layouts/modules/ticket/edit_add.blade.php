<div class="row">
    <div class="col-lg-5">
        <label for="name">Ticket Name <span class="text-danger">*</span></label>
        <div class="input-group">
            <input type="text" name="name" id="name" class="form-control" value="{{$ticket->name ?? old('name')}}"
                placeholder="Ticket Name">
        </div>
    </div>
    <div class="col-lg-5">
        <label for="color">Color</label>
        <div class="input-group">
            <input type="color" name="color" id="color" value="{{$ticket->color ?? old('color')}}"
                placeholder="Ticket Name">
        </div>
    </div>
    <div class="col-lg-2">
        <label>Active</label> <br>
        <label class="switch">
            <input type="hidden" name="active" value="0">
            <input type="checkbox" value="1" {{ isset($ticket->active) ? ($ticket->active ?
            'checked' : '') : 'checked' }}><span class="switch-state"></span>
        </label>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-6">
        <label for="image">Ticket Icon Image</label> <br>
        <input type="file" name="image" id="image" accept="image/*" onchange="readURL(this);">
    </div>
    <div class="col-lg-6 d-flex justify-content-center">
        @if (isset($ticket))
        @if (!is_null($ticket->getRawOriginal('image')))
        <br>
        <img src="{{ $ticket->image }}" alt="{{ $ticket->name ?? '' }}" class="img-fluid" id="ticket_image">
        @endif
        @endif
        <img src="" id="ticket_image_placeholder" class="img-fluid">
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <label for="description">Description</label>
        <textarea name="description" id="heavytexteditor" cols="30" rows="10">
            @isset($ticket)
                {!! $ticket->description !!}
            @endisset
        </textarea>
    </div>
</div>
<hr>
<x-adminetic-edit-add-button :model="$ticket ?? null" name="Ticket" />