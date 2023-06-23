<?php

namespace Spatie\MediaLibraryPro\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;
use Spatie\MediaLibraryPro\Rules\GroupRules\MaxItemsRule;
use Spatie\MediaLibraryPro\Rules\GroupRules\MaxTotalSizeInKbRule;
use Spatie\MediaLibraryPro\Rules\GroupRules\MinItemsRule;
use Spatie\MediaLibraryPro\Rules\GroupRules\MinTotalSizeInKbRule;
use Spatie\MediaLibraryPro\Rules\ItemRules\AttributeRule;
use Spatie\MediaLibraryPro\Rules\ItemRules\DimensionsRule;
use Spatie\MediaLibraryPro\Rules\ItemRules\ExtensionRule;
use Spatie\MediaLibraryPro\Rules\ItemRules\HeightBetweenRule;
use Spatie\MediaLibraryPro\Rules\ItemRules\MaxItemSizeInKbRule;
use Spatie\MediaLibraryPro\Rules\ItemRules\MimeTypeRule;
use Spatie\MediaLibraryPro\Rules\ItemRules\MinItemSizeInKbRule;
use Spatie\MediaLibraryPro\Rules\ItemRules\WidthBetweenRule;

class UploadedMediaRules implements Rule
{
    public array $groupRules = [];

    public array $itemRules = [];

    public function minItems(int $numberOfItems): self
    {
        $this->groupRules[] = new MinItemsRule($numberOfItems);

        return $this;
    }

    public function maxItems(int $numberOfItems): self
    {
        $this->groupRules[] = new MaxItemsRule($numberOfItems);

        return $this;
    }

    public function maxTotalSizeInKb(int $maxTotalSizeInKb): self
    {
        $this->groupRules[] = new MaxTotalSizeInKbRule($maxTotalSizeInKb);

        return $this;
    }

    public function minTotalSizeInKb(int $minTotalSizeInKb): self
    {
        $this->groupRules[] = new MinTotalSizeInKbRule($minTotalSizeInKb);

        return $this;
    }

    public function maxItemSizeInKb(int $maxSizeInKb): self
    {
        $this->itemRules[] = new MaxItemSizeInKbRule($maxSizeInKb);

        return $this;
    }

    public function minSizeInKb(int $minSizeInKb): self
    {
        $this->itemRules[] = new MinItemSizeInKbRule($minSizeInKb);

        return $this;
    }

    /** @var string|array */
    public function mime($mimes): self
    {
        $this->itemRules[] = new MimeTypeRule($mimes);

        return $this;
    }

    /**
     * @var string|array
     */
    public function extension($extensions): self
    {
        $this->itemRules[] = new ExtensionRule($extensions);

        return $this;
    }

    public function itemName($rules): self
    {
        return $this->attribute('name', $rules);
    }

    public function attribute(string $attribute, array|string $rules): self
    {
        $this->itemRules[] = new AttributeRule($attribute, $rules);

        return $this;
    }

    public function customProperty(string $customPropertyName, $rules): self
    {
        $customPropertyName = "custom_properties.{$customPropertyName}";

        $this->itemRules[] = new AttributeRule($customPropertyName, $rules);

        return $this;
    }

    public function dimensions(int $width, int $height): self
    {
        $this->itemRules[] = new DimensionsRule($width, $height);

        return $this;
    }

    public function width(int $width): self
    {
        $this->itemRules[] = new DimensionsRule($width, 0);

        return $this;
    }

    public function height(int $height): self
    {
        $this->itemRules[] = new DimensionsRule(0, $height);

        return $this;
    }

    public function widthBetween(int $minWidth, int $maxWidth): self
    {
        $this->itemRules[] = new WidthBetweenRule($minWidth, $maxWidth);

        return $this;
    }

    public function heightBetween(int $minHeight, int $maxHeight): self
    {
        $this->itemRules[] = new HeightBetweenRule($minHeight, $maxHeight);

        return $this;
    }

    public function customItemRules($rules)
    {
        $this->itemRules = array_merge($this->itemRules, Arr::wrap($rules));

        return $this;
    }
    
    public function customGroupRules($rules)
    {
        $this->groupRules = array_merge($this->groupRules, Arr::wrap($rules));

        return $this;
    }

    public function passes($attribute, $value)
    {
        // this page has been left intentionally blank
    }

    public function message()
    {
        // this page has been left intentionally blank
    }
}
