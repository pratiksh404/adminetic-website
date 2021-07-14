<div class="row">
    <div class="col-lg-4">
        <label for="name">Package Name</label>
        <div class="input-group">
            <input type="text" name="name" id="name" class="form-control" value="{{$package->name ?? old('name')}}"
                placeholder="Package Name">
        </div>
    </div>
    <div class="col-lg-4">
        <label for="package_time">Package Plan</label>
        <div class="input-group">
            <select name="package_time" id="package_time" class="select2" style="width: 100%">
                <option selected disabled>Select Package Plan ..</option>
                <option value="1"
                    {{isset($package->package_time) ? ($package->package_time == "Per Hour" ? "selected" : "") : ""}}>
                    Per Hour</option>
                <option value="2"
                    {{isset($package->package_time) ? ($package->package_time == "Per Day" ? "selected" : "") : ""}}>
                    Per Day</option>
                <option value="3"
                    {{isset($package->package_time) ? ($package->package_time == "Per Week" ? "selected" : "") : ""}}>
                    Per Week</option>
                <option value="4"
                    {{isset($package->package_time) ? ($package->package_time == "Per Month" ? "selected" : "") : ""}}>
                    Per Month</option>
                <option value="5"
                    {{isset($package->package_time) ? ($package->package_time == "Per Year" ? "selected" : "") : ""}}>
                    Per Year</option>
                <option value="6"
                    {{isset($package->package_time) ? ($package->package_time == "Custom Plan" ? "selected" : "") : ""}}>
                    Custom Plan</option>
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <label for="package_cost">Package Cost</label>
        <div class="input-group">
            <span class="input-group-text">{{config('adminetic.currency_symbol','Rs.')}}</span>
            <input type="number" name="package_cost" id="package_cost" class="form-control"
                value="{{$package->package_cost ?? old('package_cost') ?? 0}}" placeholder="Package Cost" min="0">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-2">
        <label for="active">Active</label>
        <div class="mb-2">
            <label class="switch">
                <input type="hidden" name="active" value="0">
                <input name="active" type="checkbox" value="1" id="active"
                    {{isset($package->active) ? ($package->active ? 'checked' : '') : 'checked'}}><span
                    class="switch-state"></span>
            </label>
        </div>
    </div>
    <div class="col-lg-4">
        <label for="color">Color</label>
        <div class="input-group">
            <input name="color" class="form-control form-control-color" type="color"
                value="{{$category->color ?? old('color') ?? '#563d7c'}}">
        </div>
    </div>
    <div class="col-lg-6">
        <label for="link">Link (Optional)</label>
        <div class="input-group">
            <input type="text" name="link" id="link" class="form-control" value="{{$package->link ?? old('link')}}"
                placeholder="Link">
        </div>
    </div>
</div>
<br>
<div class="card shadow-sm">
    <div class="card-header">
        <h4 class="card-title">Features</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <th>
                                <button type="button" class="btn btn-primary" id="add_feature"><i
                                        class="fas fa-plus"></i></button>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="features">
                        @if(isset($package->features))
                        @foreach ($package->features as $feature)
                        <tr class="feature_unit">
                            <td><input type="text" name="features[]" class="feature form-control" value="{{$feature}}">
                            </td>
                            <td><button type="button" class="btn btn-danger delete-feature"><i
                                        class="fas fa-trash"></i></button></td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="feature_unit">
                            <td><input type="text" name="features[]" class="feature form-control"></td>
                            <td><button type="button" class="btn btn-danger delete-feature"><i
                                        class="fas fa-trash"></i></button></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<x-adminetic-edit-add-button :model="$package ?? null" name="Package" />