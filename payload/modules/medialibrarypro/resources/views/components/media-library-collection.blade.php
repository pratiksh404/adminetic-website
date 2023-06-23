@include('media-library::components.partials.media-library-once')
<livewire:media-library
    :key="'media-library-component' . $name"
    :media="$media"
    :model="$model"
    :name="$name"
    :rules="$rules"
    :maxItems="$maxItems"
    :multiple="$multiple"
    :sortable="$sortable"
    :view="$componentView ?? null"
    :listView="$listView"
    :itemView="$itemView"
    :propertiesView="$propertiesView ?? null"
    :fieldsView="$fieldsView ?? null"
    :editableName="$editableName"
/>

{{--
If we are in Livewire context, we are going emit an event so the
initial state of the collection component is emitted to the
Livewire component where the collection is used in.
--}}
@php
    if (isset($_instance)) {
        if (in_array(\Spatie\MediaLibraryPro\Http\Livewire\Concerns\WithMedia::class, class_uses_recursive($_instance))) {
            if ($_instance->$name === null) {
                $_instance->onMediaChanged($name, $media);
            }
        }
    }
@endphp
