<div>
    @if ($multiple)
        <x-media-library-attachment name="{{ $attribute }}" multiple />
    @else
        <x-media-library-attachment name="{{ $attribute }}" />
    @endif
    <hr>
    @if (!is_null($model))
        @if ($multiple)
            @if ($model->getMedia($attribute)->count() > 0)
                <div class="row">
                    @foreach ($model->getMedia($attribute) as $image)
                        <div class="col-lg-3">
                            <div class="product-box">
                                <div class="product-img">
                                    <div class="img-hover hover-1">
                                        <img class="img-fluid" src="{{ $image->getUrl() }}" alt="{{ $image->file_name }}">
                                    </div>
                                    <div class="product-hover">
                                        <ul>
                                            <li>
                                                <button class="btn" type="button"
                                                    wire:click="removeImage({{ $image->id }})"><i
                                                        class="fa fa-trash"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-details">
                                    <div class="d-flex justify-content-center">
                                        <b>{{ $image->file_name }}</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @else
            @if ($model->getFirstMedia($attribute))
                <div class="product-box">
                    <div class="product-img">
                        <div class="img-hover hover-1">
                            <img class="img-fluid" src="{{ $model->getFirstMedia($attribute)->getUrl() }}"
                                alt="{{ $model->getFirstMedia($attribute)->file_name }}">
                        </div>
                        <div class="product-hover">
                            <ul>
                                <li>
                                    <button class="btn" type="button"
                                        wire:click="removeImage({{ $model->getFirstMedia($attribute)->id }})"><i
                                            class="fa fa-trash"></i></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-details">
                        <div class="d-flex justify-content-center">
                            <b>{{ $model->getFirstMedia($attribute)->file_name }}</b>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endif
</div>
