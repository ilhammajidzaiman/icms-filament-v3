<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     */
    public function created(Article $Article): void
    {
        //
    }

    /**
     * Handle the Article "updated" event.
     */
    public function updated(Article $Article): void
    {
        if ($Article->isDirty('file')) {
            Storage::disk('public')->delete($Article->getOriginal('file'));
        }
    }

    /**
     * Handle the Article "deleted" event.
     */
    public function deleted(Article $Article): void
    {
        //
    }

    /**
     * Handle the Article "restored" event.
     */
    public function restored(Article $Article): void
    {
        // 
    }

    /**
     * Handle the Article "force deleted" event.
     */
    public function forceDeleted(Article $Article): void
    {
        if (!is_null($Article->file)) {
            Storage::disk('public')->delete($Article->file);
        }
    }
}
