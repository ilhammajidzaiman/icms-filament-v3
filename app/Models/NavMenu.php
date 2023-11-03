<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SolutionForest\FilamentTree\Concern\ModelTree;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NavMenu extends Model
{
    use HasFactory, SoftDeletes, ModelTree;

    protected $fillable = [
        'user_id',
        'parent_id',
        'order',
        'modelable_type',
        'modelable_id',
        'title',
        'slug',
        'is_active',
    ];

    // protected $table = 'nav_menus';

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function modelable(): MorphTo
    {
        return $this->morphTo();
    }
}
