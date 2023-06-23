<?php

namespace Spatie\MediaLibraryPro\Rules\GroupRules;

use Illuminate\Contracts\Validation\Rule;

class MaxItemsRule implements Rule
{
    public function __construct(protected int $maxItemCount)
    {
    }

    public function passes($attribute, $value)
    {
        return (is_countable($value) ? count($value) : 0) <= $this->maxItemCount;
    }

    public function message()
    {
        return trans_choice('media-library::validation.max_items', $this->maxItemCount, [
            'max' => $this->maxItemCount,
        ]);
    }
}
