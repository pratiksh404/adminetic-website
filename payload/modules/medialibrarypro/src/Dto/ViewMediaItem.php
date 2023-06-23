<?php

namespace Spatie\MediaLibraryPro\Dto;

use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;

class ViewMediaItem
{
    public function __construct(
        protected string $formFieldName,
        protected array $mediaAttributes
    ) {
    }

    public function __get($name)
    {
        return $this->mediaAttributes[$name] ?? null;
    }

    public function propertyAttributeName(string $name): string
    {
        return "{$this->formFieldName}[{$this->uuid}][$name]";
    }

    public function customPropertyAttributes(string $name): HtmlString
    {
        return new HtmlString(implode(PHP_EOL, [
            "name='{$this->customPropertyAttributeName($name)}'",
            "value='{$this->customPropertyAttributeValue($name)}'",
        ]));
    }

    public function livewireCustomPropertyAttributes(string $name, int $debounceInMs = 150): HtmlString
    {
        return new HtmlString(implode(PHP_EOL, [
                'x-data',
                'x-on:keyup.debounce.' . $debounceInMs . '="$wire.setCustomProperty(\'' . $this->uuid .'\', \''  . $name . '\', document.getElementsByName(\'' . $this->customPropertyAttributeName($name) .'\')[0].value)"',
                $this->customPropertyAttributes($name),
        ]));
    }

    public function customPropertyAttributeName(string $name): string
    {
        return "{$this->formFieldName}[{$this->uuid}][custom_properties][$name]";
    }

    public function customPropertyAttributeValue(string $name)
    {
        $value = Arr::get($this->mediaAttributes['customProperties'] ?? [], $name);

        return old($this->customPropertyErrorName($name), $value);
    }

    public function errorName(): string
    {
        return "{$this->formFieldName}.{$this->uuid}";
    }


    public function propertyErrorName(string $name): string
    {
        return "{$this->formFieldName}.{$this->uuid}.{$name}";
    }

    public function customPropertyErrorName(string $name): string
    {
        return "{$this->formFieldName}.{$this->uuid}.custom_properties.$name";
    }

    public function downloadUrl(): string
    {
        $mediaModelClass = config('media-library.media_model');

        return $mediaModelClass::findByUuid($this->uuid)->getUrl();
    }

    public function createdAt(): Carbon
    {
        return Carbon::createFromTimestamp($this->mediaAttributes['createdAt']);
    }
}
