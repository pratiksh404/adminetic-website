@include('media-library::components.partials.media-library-once')
<livewire:media-library
    :key="'media-library-component' . $name"
    :media="$media"
    :name="$name"
    :rules="$rules"
    :multiple="$multiple"
    :maxItems="$determineMaxItems()"
    :view="$componentView ?? null"
    :sortable="false"
    :listView="$determineListViewName()"
    :itemView="$determineItemViewName()"
    :propertiesView="$propertiesView ?? null"
    :fieldsView="$determineFieldsViewName()"
    :editableName="$editableName"
/>
