<?php

namespace Adminetic\Website\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait HasFileUpload
{
    public function fileUpload($file, $directory, $given_name = null)
    {
        if (!$file->isValid()) {
            throw new \Exception('File was not uploaded successfully');
        }

        /** Check if folder exits or not. If not then create the folder */
        if (!File::exists(storage_path($directory))) {
            File::makeDirectory(storage_path($directory), 0775, true);
        }

        $original_name = strtolower(str_replace([' ', '-', '$', '<', '>', '&', '{', '}', '*', '\\', '/', ':', '.', ';', ',', "'", '"'], '_', trim($given_name ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))));
        $timestamp = Carbon::now()->toDateString();
        $extension = $file->getClientOriginalExtension();
        $size = $file->getSize();
        $name = str_replace(' ', '', $original_name . '-' . Carbon::now()->toDateString() . '-' . $size . '.' . $file->getClientOriginalExtension());

        $disk = config('filesystems.default', 'public');

        $path = null;
        if ($disk == 'public') {
            $path = $file->storeAs($directory, $name, 'public');
        } else {
            $path = Storage::disk($disk)->putFileAs(
                $directory,
                $file,
                $name
            );
        }

        return json_decode(json_encode([
            'original_name' => $original_name ?? null,
            'timestamp' => $timestamp ?? null,
            'extension' => $extension ?? null,
            'size' => $size ?? null,
            'name' => $name ?? null,
            'path' => $path ?? null,
        ]));
    }
}
