<div class="row">
    <div class="col-lg-6">
        <label for="name">Counter Name</label>
        <div class="input-group">
            <input type="text" name="name" id="name" class="form-control" value="{{$counter->name ?? old('name')}}"
                placeholder="Counter Name">
        </div>
    </div>
    <div class="col-lg-6">
        <label for="value">Counter Value</label>
        <div class="input-group">
            <input type="number" name="value" id="value" class="form-control"
                value="{{$counter->value ?? old('value')}}" placeholder="Counter Value">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-6">
        <label for="icon">Counter Image <span class="text-danger">*</span></label> <br>
        <input type="file" name="icon" id="icon" accept="icon/*" onchange="readURL(this);">
    </div>
    <div class="col-lg-6">
        @if (isset($counter->icon))
        <img src="{{asset('storage/'.$counter->icon)}}" alt="{{$counter->icon ?? ''}}" class="img-fluid" width="40"
            height="40" id="counter_icon">
        @endif
        <img src="" id="counter_icon_plcaeholder" class="img-fluid">
    </div>
</div>
<x-adminetic-edit-add-button :model="$counter ?? null" name="Counter" />