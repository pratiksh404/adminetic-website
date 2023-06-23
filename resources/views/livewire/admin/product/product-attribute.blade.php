<div>
    @if ($attributes->count() > 0)
        <div class="row">
            @foreach ($attributes->chunk(5) as $group)
                <div class="col-lg-4">
                    <ul>
                        @foreach ($group as $attribute)
                            <li>
                                <input type="checkbox" wire:model="selected_attribute_ids" value="{{ $attribute->id }}">
                                {{ $attribute->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
        <br>
        @if (!is_null($selected_attributes))
            @if ($selected_attributes->count() > 0)
                <div class="row">
                    @foreach ($selected_attributes as $selected_attribute)
                        @if (count($selected_attribute->values ?? []) > 0)
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        {{ $selected_attribute->name }}
                                    </div>
                                    <div class="card-body p-3">
                                        <ul>
                                            @foreach ($selected_attribute->values as $index => $value)
                                                <li>
                                                    <input type="checkbox"
                                                        wire:model="product_attributes.{{ $selected_attribute->id }}"
                                                        name="product_attributes[{{ $selected_attribute->id }}][]"
                                                        value="{{ $value }}">
                                                    @if ($selected_attribute->name == 'Color' || $selected_attribute->name == 'color')
                                                        <span class="badge"
                                                            style="width: 60px;height:30px;background-color:{{ $value }};color:white">{{ $value }}</span>
                                                    @else
                                                        {{ $value }}
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        @endif
    @endif
</div>
