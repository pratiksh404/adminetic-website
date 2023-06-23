<?php

namespace Spatie\MediaLibraryPro\Rules\GroupRules;

use Illuminate\Contracts\Validation\Rule;

class MinItemsRule implements Rule
{
    public function __construct(protected int $minItemCount)
    {
    }

    public function getMinItemCount()
    {
        return $this->minItemCount;
    }

    public function passes($attribute, $value)
    {
        return (is_countable($value) ? count($value) : 0) >= $this->minItemCount;
    }

    public function message()
    {
        return trans_choice('media-library::validation.min_items', $this->minItemCount, [
            'min' => $this->minItemCount,
        ]);
    }
}
