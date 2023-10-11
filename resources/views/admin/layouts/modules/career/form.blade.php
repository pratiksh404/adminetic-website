<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-7">
                <label for="title">Title <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ $career->title ?? old('title') }}" placeholder="Title">
                </div>
            </div>
            <div class="col-lg-5">
                <label for="designation">Designation</label>
                <div class="input-group">
                    <input type="text" name="designation" id="designation" class="form-control"
                        value="{{ $career->designation ?? old('designation') }}" placeholder="Job Title">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-4">
                <label for="salary">Salary <span class="text-muted">*</span></label>
                <div class="input-group">
                    <input type="text" name="salary" id="salary" class="form-control"
                        value="{{ $career->salary ?? old('salary') }}" placeholder="Negotiable, Rs.30000, Rs.40000 ..">
                </div>
            </div>
            <div class="col-lg-12">
                <label for="salary">Deadline <span class="text-muted">*</span></label>
                <div class="input-group">
                    <input type="text" name="deadline" id="deadline" class="form-control"
                        value="{{ $career->deadline ?? old('deadline') }}">
                </div>
            </div>
            <div class="col-lg-4">
                <label for="salary">Working Location</label>
                <div class="input-group">
                    <input type="text" name="location" id="location" class="form-control"
                        value="{{ $career->location ?? old('location') }}" placeholder="Working Location">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <label>Summary</label>
                <br>
                @livewire('admin.career.summary', ['career_id' => $career->id ?? null])
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <label for="excerpt">Short Description About Job Opening <span class="text-danger">*</span></label>
                <textarea name="excerpt" id="excerpt" cols="30" rows="10" class="form-control">{{ $career->excerpt ?? old('excerpt') }}</textarea>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <label for="description">Description</label>
                <textarea name="description" id="heavytexteditor" cols="30" rows="10">
                    @isset($career->description)
{!! $career->description !!}
@endisset
                </textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
            <div class="col-12">
                <label for="group">Group</label>
                <br>
                <select name="group" id="group" class="form-control">
                    <option selected disabled>Select Group ..</option>
                    @foreach (config('website.career_group') as $group_id => $career_group)
                        <option value="{{ $group_id }}"
                            {{ isset($career->group) ? ($career->getRawOriginal('group') == $group_id ? 'selected' : '') : '' }}>
                            {{ $career_group }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        {{-- {{dd($career->application_description)}} --}}
        <div class="row">
            <div class="col-12">
                <label for="application_description">Description</label>
                <br>
                @if(isset($career->application_description))
                <a href="{{$career->application_description}}" download="{{$career->title}}">{{$career->title}}</a>
                {{-- <input type="file" name="application_description" value="{{$career->application_description}}"> --}}
                <br>
                @endif
                <input type="file" name="application_description" id="application_description">
            </div>
        </div>
        {{--         <br>
        <div class="row">
            <div class="col-12">
                <label for="application_syllabus">Syllabus</label>
                <br>
                <input type="file" name="application_syllabus" id="application_syllabus">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <label for="application_sort_list">Sort List</label>
                <br>
                <input type="file" name="application_sort_list" id="application_sort_list">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <label for="application_result">Result</label>
                <br>
                <input type="file" name="application_result" id="application_result">
            </div>
        </div> --}}
        <br>
        <div class="row">
            <div class="col-12">
                <label for="add_apply_button">Add Apply Button</label> <br>
                <label class="switch">
                    <input type="hidden" name="add_apply_button" value="0">
                    <input type="checkbox" value="1" name="add_apply_button"
                        {{ isset($career->add_apply_button) ? ($career->add_apply_button ? 'checked' : '') : '' }}><span
                        class="switch-state"></span>
                </label>
            </div>
            <div class="col-12">
                <label for="active">Active</label> <br>
                <label class="switch">
                    <input type="hidden" name="active" value="0">
                    <input type="checkbox" name="active" value="1"
                        {{ isset($career->active) ? ($career->active ? 'checked' : '') : 'checked' }}><span
                        class="switch-state"></span>
                </label>
            </div>
        </div>
        <br>
        <x-adminetic-edit-add-button :model="$career ?? null" name="Career" />
    </div>
</div>
