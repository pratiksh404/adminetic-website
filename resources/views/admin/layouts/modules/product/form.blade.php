<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="mt-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="name">{{ label('products', 'name') }}</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $product->name ?? old('name') }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="generic_name">Generic Name</label>
                            <input type="text" name="generic_name" id="generic_name" class="form-control"
                                value="{{ $product->generic_name ?? old('generic_name') }}">
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="strength">Strength</label>
                            <input type="text" name="strength" id="strength" class="form-control"
                                value="{{ $product->strength ?? old('strength') }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="dosage_form">Dosage Form</label>
                            <input type="text" name="dosage_form" id="dosage_form" class="form-control" value="{{ $product->dosage_form ?? old('dosage_form') }}">
                        </div>
                    </div>

                </div>
                <div class="mt-4">
                    <label for="excerpt">{{ label('products', 'excerpt') }}</label>
                    <textarea name="excerpt" id="excerpt" class="form-control" cols="30" rows="10">{{ $product->excerpt ?? old('excerpt') }}</textarea>
                </div>
                <br>
                <div class="mt-4">
                    <label for="description">{{ label('products', 'description') }}</label>
                    <textarea id="heavytexteditor" name="description">
                        @isset($product->description)
{!! $product->description !!}
@endisset
                    </textarea>
                </div>
            </div>
        </div>
        {{-- <div class="card">
            <div class="card-body shadow-lg p-3">
                @livewire('admin.product.product-attribute', ['product' => $product ?? null])
            </div>
        </div> --}}
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body shadow-lg p-3">
                @livewire('admin.category.quick-category', ['model' => 'Product', 'category_id' => $product->category_id ?? null, 'attribute' => 'category_id'])
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="mt-4">
                    <label for="cost_price">{{ label('products', 'cost_price') }}</label>
                    <input type="number" step="any" name="cost_price" id="cost_price" class="form-control"
                        value="{{ $product->cost_price ?? (old('cost_price') ?? 0) }}">
                </div>
                <br>
                <div class="mt-4">
                    <label for="selling_price">{{ label('products', 'selling_price') }}</label>
                    <input type="number" step="any" name="selling_price" id="selling_price" class="form-control"
                        value="{{ $product->selling_price ?? (old('selling_price') ?? 0) }}">
                </div>
                <br>
                <div class="mt-4">
                    <label for="discount">{{ label('products', 'discount') }}</label>
                    <input type="number" step="any" name="discount" id="discount" class="form-control"
                        value="{{ $product->discount ?? old('discount') ?? 0 }}">
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="mt-4">
                    <label for="quantity">{{ label('products', 'quantity') }}</label>
                    <input type="number" name="quantity" id="quantity" class="form-control"
                        value="{{ $product->quantity ?? (old('quantity') ?? 1) }}">
                </div>
                <br>
                <div class="mt-4">
                    <label for="quantity_alert">{{ label('products', 'quantity_alert') }}</label>
                    <input type="number" name="quantity_alert" id="quantity_alert" class="form-control"
                        value="{{ $product->quantity_alert ?? (old('quantity_alert') ?? 1) }}">
                </div>
                <br>
                <div class="mt-4">
                    <label for="points">{{ label('products', 'points', 'Point per item sold') }}</label>
                    <input type="number" step="any" name="points" id="points" class="form-control"
                        value="{{ $product->points ?? (old('points') ?? 0) }}">
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Product Image
            </div>
            <div class="card-body shadow-lg p-3">
                @livewire('admin.system.upload-image', ['model' => $product ?? null, 'attribute' => 'image', 'multiple' => false])
            </div>
        </div>
        <div class="card">
            <div class="card-body shadow-lg p-3">
                <div class="mt-4">
                    <label for="meta_name">{{ label('products', 'meta_name', 'Meta Name') }}</label>
                    <div class="input-group">
                        <input type="text" name="meta_name" id="meta_name" class="form-control"
                            value="{{ $product->meta_name ?? old('meta_name') }}" placeholder="Meta Name">
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <label
                        for="meta_description">{{ label('products', 'meta_description', 'Meta Description') }}</label>
                    <textarea name="meta_description" id="meta_description" cols="30" rows="10" class="form-control">{{ $product->meta_description ?? old('meta_description') }}</textarea>
                </div>
                <br>
                <div class="mt-4">
                    <label for="meta_keywords">{{ label('products', 'meta_keywords', 'Meta Keywords') }}</label>
                    <div class="input-group">
                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                            value="{{ $product->meta_keywords ?? old('meta_keywords') }}"
                            placeholder="Meta Keywords">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<x-adminetic-edit-add-button :model="$post ?? null" name="Post" />
