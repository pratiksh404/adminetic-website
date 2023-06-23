<div class="row">
    <div class="col-12">
        <label for="name">Coupon Name</label>
        <div class="input-group">
            <input type="text" name="name" id="name" class="form-control" value="{{$coupon->name ?? old('name')}}"
                placeholder="Coupon Name">
        </div>
    </div>
</div>
<hr>
<x-adminetic-edit-add-button :model="$coupon ?? null" name="Coupon" />