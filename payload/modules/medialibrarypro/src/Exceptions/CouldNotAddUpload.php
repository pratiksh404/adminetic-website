<?php

namespace Spatie\MediaLibraryPro\Exceptions;

use Exception;

class CouldNotAddUpload extends Exception
{
    public static function uuidAlreadyExists()
    {
        return new static("The given uuid is being used for an existing media item.");
    }
}
