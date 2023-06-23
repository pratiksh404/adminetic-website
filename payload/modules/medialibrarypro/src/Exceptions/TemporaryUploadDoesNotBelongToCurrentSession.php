<?php

namespace Spatie\MediaLibraryPro\Exceptions;

use Exception;

class TemporaryUploadDoesNotBelongToCurrentSession extends Exception
{
    public static function create(): self
    {
        return new static('The session id of the given temporary upload does not match the current session id.');
    }
}
