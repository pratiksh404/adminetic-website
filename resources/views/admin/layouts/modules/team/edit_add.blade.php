<div class="row">
    <div class="col-lg-2">
        <label for="code">Code</label>
        <div class="input-group">
            <button class="btn btn-outline-primary p-2" type="button" id="code_reload"><i
                    class="fa fa-sync"></i></button>
            <input name="code" type="number" class="form-control" id="code"
                value="{{$category->code ?? old('category')}}" placeholder="Code">
        </div>
    </div>
    <div class="col-lg-6">
        <label for="name">Member Name <span class="text-danger">*</span></label>
        <div class="input-group">
            <input type="text" name="name" id="name" class="form-control" value="{{$team->name ?? old('name')}}"
                placeholder="Member Name">
        </div>
    </div>
    <div class="col-lg-4">
        <label for="group">Group</label>
        <div class="input-group">
            <input type="number" name="group" id="group" class="touchspin"
                value="{{$team->group ?? old('group') ?? 1}}">
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-6">
        <label for="designation">Member Designation <span class="text-danger">*</span></label>
        <div class="input-group">
            <input type="text" name="designation" id="designation" class="form-control"
                value="{{$team->designation ?? old('designation')}}" placeholder="Member Designation">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-6">
                <label for="image">Member Image</label>
                <div class="input-group">
                    <input type="file" name="image" id="image" accept="image/*" onchange="readURL(this);">
                </div>
            </div>
            <div class="col-lg-6">
                @if (isset($team->image))
                <img src="{{asset($team->thumbnail('image','small'))}}" alt="{{$team->name}}">
                @endif
                <img src="" id="team_image_plcaeholder" class="img-fluid">
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <label for="phone">Phone</label>
        <div class="input-group">
            <select name="phone[]" id="phone" class="phone form-control" multiple>
                @isset($team->phone)
                @if (count($team->phone) > 0)
                @foreach ($team->phone as $phone)
                <option value="{{$phone}}" selected>{{$phone}}</option>
                @endforeach
                @endif
                @endisset
            </select>
        </div>
    </div>
</div>
<br>
<div class="form-section">
    <h4>Member Social Media</h4>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-12">
                <label for="email">Email</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                    </div>
                    <input type="text" name="email" id="email" class="form-control"
                        value="{{$team->email ?? old('email')}}" placeholder="Member Email">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <label for="facebook">Facebook</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                    </div>
                    <input type="text" name="facebook" id="facebook" class="form-control"
                        value="{{$team->facebook ?? old('facebook')}}" placeholder="Member Facebook">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <label for="instagram">Instagram</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                    </div>
                    <input type="text" name="instagram" id="instagram" class="form-control"
                        value="{{$team->instagram ?? old('instagram')}}" placeholder="Member Instagram">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <label for="messenger">Messenger</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-facebook-messenger"></i></span>
                    </div>
                    <input type="text" name="messenger" id="messenger" class="form-control"
                        value="{{$team->messenger ?? old('messenger')}}" placeholder="Member Messenger">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-12">
                <label for="twitter">Twitter</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                    </div>
                    <input type="text" name="twitter" id="twitter" class="form-control"
                        value="{{$team->twitter ?? old('twitter')}}" placeholder="Member Twitter">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <label for="linkedin">Linkedin</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                    </div>
                    <input type="text" name="linkedin" id="linkedin" class="form-control"
                        value="{{$team->linkedin ?? old('linkedin')}}" placeholder="Member Linkedin">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <label for="github">Github</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-github"></i></span>
                    </div>
                    <input type="text" name="github" id="github" class="form-control"
                        value="{{$team->github ?? old('github')}}" placeholder="Member Github">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <label for="whatsapp">Whatsapp</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                    </div>
                    <input type="text" name="whatsapp" id="whatsapp" class="form-control"
                        value="{{$team->whatsapp ?? old('whatsapp')}}" placeholder="Member Whatsapp">
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <label for="message">Member Message</label>
        <textarea name="message" id="heavytexteditor">
                @if (isset($team->message))
                    {!! $team->message !!}
                @endif
            </textarea>
    </div>
</div>
<x-adminetic-edit-add-button :model="$team ?? null" name="Team" />