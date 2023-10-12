<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="mt-4">
                    <label for="name">{{ label('teams', 'name') }}</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ $team->name ?? old('name') }}" placeholder="Team Name">
                </div>
                <div class="mt-4">
                    <label for="short_message">{{ label('teams', 'short_message', 'Short Message') }}</label>
                    <textarea name="short_message" id="short_message" cols="30" rows="10" class="form-control">{{ $team->short_message ?? old('short_message') }}</textarea>
                </div>
                <div class="mt-4">
                    <label for="description">{{ label('teams', 'description') }}</label>
                    <textarea name="description" id="heavytexteditor" cols="30" rows="10">
                        @isset($team->description)
{!! $team->description !!}
@endisset
                    </textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="phone">{{ label('teams', 'phone') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                            </div>
                            <input type="phone" name="phone" id="phone" class="form-control"
                                value="{{ $team->phone ?? old('phone') }}" placeholder="Team Phone">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Profile Image
            </div>
            <div class="card-body shadow-lg p-3">
                @livewire('admin.system.upload-image', ['model' => $service ?? null, 'attribute' => 'image'])
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Social Media
            </div>
            <div class="card-body shadow-lg p-3">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                            </div>
                            <input type="text" name="social_medias[email]" id="email" class="form-control"
                                value="{{ $team->social_medias['email'] ?? old('social_medias[email]') }}"
                                placeholder="Team Email">
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
                            <input type="text" name="social_medias[facebook]" id="facebook" class="form-control"
                                value="{{ $team->social_medias['facebook'] ?? old('social_medias[facebook]') }}"
                                placeholder="Team Facebook">
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
                            <input type="text" name="social_medias[instagram]" id="instagram" class="form-control"
                                value="{{ $team->social_medias['instagram'] ?? old('social_medias[instagram]') }}"
                                placeholder="Team Instagram">
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
                            <input type="text" name="social_medias[messenger]" id="messenger" class="form-control"
                                value="{{ $team->social_medias['messenger'] ?? old('social_medias[messenger]') }}"
                                placeholder="Team Messenger">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <label for="twitter">Twitter</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                            </div>
                            <input type="text" name="social_medias[twitter]" id="twitter" class="form-control"
                                value="{{ $team->social_medias['twitter'] ?? old('social_medias[twitter]') }}"
                                placeholder="Team Twitter">
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
                            <input type="text" name="social_medias[linkedin]" id="linkedin" class="form-control"
                                value="{{ $team->social_medias['linkedin'] ?? old('social_medias[linkedin]') }}"
                                placeholder="Team Linkedin">
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
                            <input type="text" name="social_medias[github]" id="github" class="form-control"
                                value="{{ $team->social_medias['github'] ?? old('social_medias[github]') }}"
                                placeholder="Team Github">
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
                            <input type="text" name="social_medias[whatsapp]" id="whatsapp" class="form-control"
                                value="{{ $team->social_medias['whatsapp'] ?? old('social_medias[whatsapp]') }}"
                                placeholder="Team Whatsapp">
                        </div>
                    </div>
                </div>
                <br>
                <x-adminetic-edit-add-button :model="$team ?? null" name="Team" />
            </div>
        </div>
    </div>
</div>
