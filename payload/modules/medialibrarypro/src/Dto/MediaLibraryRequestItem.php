<?php

namespace Spatie\MediaLibraryPro\Dto;

use Illuminate\Support\Str;

class MediaLibraryRequestItem
{
    public static function fromArray(array $properties): self
    {
        $properties = collect($properties)
            ->keyBy(fn ($value, $key) => Str::snake($key));

        return new static(
            $properties['uuid'],
            $properties['name'] ?? '',
            $properties['order'] ?? 0,
            $properties['custom_properties'] ?? [],
            $properties['custom_headers'] ?? [],
            $properties['file_name'] ?? null,
        );
    }

    protected function __construct(
        public string $uuid,
        public string $name,
        public int $order,
        public array $customProperties,
        public array $customHeaders,
        public ?string $fileName = null,
    ) {
    }
}
