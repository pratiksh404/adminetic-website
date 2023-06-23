<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-4">
                    <label for="name">{{ label('testimonials', 'name') }}</label>
                    <div class="input-group">
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $testimonial->name ?? old('name') }}" placeholder="Testimonial Name">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mt-4">
                    <label for="email">{{ label('testimonials', 'email') }}</label>
                    <div class="input-group">
                        <input type="text" name="email" id="email" class="form-control"
                            value="{{ $testimonial->email ?? old('email') }}" placeholder="Testimonial Email">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-4">
                    <label for="company">{{ label('testimonials', 'company') }}</label>
                    <div class="input-group">
                        <input type="text" name="company" id="company" class="form-control"
                            value="{{ $testimonial->company ?? old('company') }}" placeholder="Testimonial Company">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mt-4">
                    <label for="designation">{{ label('testimonials', 'designation') }}</label>
                    <div class="input-group">
                        <input type="text" name="designation" id="designation" class="form-control"
                            value="{{ $testimonial->designation ?? old('designation') }}"
                            placeholder="Testimonial Designation">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <label for="message">{{ label('testimonials', 'message') }}</label>
                <textarea name="message" id="heavytexteditor" cols="30" rows="10">
            @isset($testimonial->message)
{!! $testimonial->message !!}
@endisset
        </textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mt-4">
            <label for="rating">{{ label('testimonials', 'rating') }}</label>
            <div class="input-group">
                <input type="number" step="any" name="rating" id="rating" class="form-control"
                    value="{{ $testimonial->rating ?? old('rating') }}" placeholder="Testimonial Rating" max="5"
                    min="0">
            </div>
        </div>
        <br>
        <div class="mt-4">
            <label>{{ label('testimonials', 'approved') }}</label> <br>
            <input type="hidden" name="approved" value="0">
            <input type="checkbox" name="approved" id="approved" value="1"
                {{ isset($testimonial->approved) ? ($testimonial->approved ? 'checked' : '') : 'checked' }}>
        </div>
        <br>
        <div class="mt-4">
            @livewire('admin.system.upload-image', ['model' => $testimonial ?? null, 'attribute' => 'image'])
        </div>
    </div>
</div>
<br>
<x-adminetic-edit-add-button :model="$testimonial ?? null" name="Testimonial" />
