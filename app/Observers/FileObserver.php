<?php

namespace App\Observers;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileObserver
{
    /**
     * Handle the File "created" event.
     */
    public function created(File $file): void
    {
        //
    }

    /**
     * Handle the File "updated" event.
     */
    public function updated(File $file): void
    {
        if ($file->isDirty('file')) {
            Storage::disk('public')->delete($file->getOriginal('file'));
        }
    }

    /**
     * Handle the File "deleted" event.
     */
    public function deleted(File $file): void
    {
        //
    }

    /**
     * Handle the File "restored" event.
     */
    public function restored(File $file): void
    {
        //
    }

    /**
     * Handle the File "force deleted" event.
     */
    public function forceDeleted(File $file): void
    {
        if (!is_null($file->file)) {
            Storage::disk('public')->delete($file->file);
        }
    }
}
