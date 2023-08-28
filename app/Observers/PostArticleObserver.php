<?php

namespace App\Observers;

use App\Models\PostArticle;
use Illuminate\Support\Facades\Storage;

class PostArticleObserver
{
    /**
     * Handle the PostArticle "created" event.
     */
    public function created(PostArticle $postArticle): void
    {
        //
    }

    /**
     * Handle the PostArticle "updated" event.
     */
    public function updated(PostArticle $postArticle): void
    {
        if ($postArticle->isDirty('file')) {
            Storage::disk('public')->delete($postArticle->getOriginal('file'));
        }
    }

    /**
     * Handle the PostArticle "deleted" event.
     */
    public function deleted(PostArticle $postArticle): void
    {
        //
    }

    /**
     * Handle the PostArticle "restored" event.
     */
    public function restored(PostArticle $postArticle): void
    {
        // 
    }

    /**
     * Handle the PostArticle "force deleted" event.
     */
    public function forceDeleted(PostArticle $postArticle): void
    {
        if (!is_null($postArticle->file)) {
            Storage::disk('public')->delete($postArticle->file);
        }
    }
}
