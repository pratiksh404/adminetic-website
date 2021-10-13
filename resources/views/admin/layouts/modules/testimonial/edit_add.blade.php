<div class="row">
    <div class="col-lg-4">
        <div class="mb-2">
            <label for="name">Person Name <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" name="name" id="name" class="form-control" value="{{$project->name ?? old('name')}}"
                    placeholder="Person Name">
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-2">
            <label for="email">Person Email</label>
            <div class="input-group">
                <input type="email" name="email" id="email" class="form-control"
                    value="{{$project->email ?? old('email')}}" placeholder="Person Email">
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-2">
            <label for="contact">Person Contact</label>
            <div class="input-group">
                <input type="number" name="contact" id="contact" class="form-control"
                    value="{{$project->contact ?? old('contact')}}" placeholder="Person Contact">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="mb-2">
            <label for="designation">Person Designation</label>
            <div class="input-group">
                <input type="text" name="designation" id="designation" class="form-control"
                    value="{{$project->designation ?? old('designation')}}" placeholder="Person Name">
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-2">
            <label for="company">Person Email</label>
            <div class="input-group">
                <input type="text" name="company" id="company" class="form-control"
                    value="{{$project->company ?? old('company')}}" placeholder="Person Email">
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <label for="approve">Approve</label>
        <div class="mb-2">
            <label class="switch">
                <input type="hidden" name="approve" value="0">
                <input name="approve" type="checkbox" value="1" id="approve" {{isset($block->approve) ? ($block->approve
                ?
                'checked' : '') : 'checked'}}><span class="switch-state"></span>
            </label>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-6">
        <label for="image">Person Image</label>
        <div class="input-group">
            <input type="file" name="image" id="image" accept="image/*" onchange="readURL(this);">
        </div>
    </div>
    <div class="col-lg-6">
        @if (isset($testimonial->image))
        <img src="{{asset('storage/'.$testimonial->image)}}" alt="{{$testimonial->name ?? ''}}" class="img-fluid"
            id="testimonial_image" style="width: 60px">
        @endif
        <img src="" id="testimonial_image_plcaeholder" class="img-fluid">
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <label for="body">Body <span class="text-danger">*</span></label>
        <textarea name="body" id="heavytexteditor">
            @isset($testimonial->body)
                {!! $testimonial->body !!}
            @endisset
        </textarea>
    </div>
</div>
<x-adminetic-edit-add-button :model="$testimonial ?? null" name="Testimonial" />