<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'authorId',
        'ownerId',
        'task',
        'priority',
        'status',
    ];

    /**
     * Get the user associated with the author.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'authorId');
    }

    /**
     * Get the user associated with the owner.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ownerId');
    }


}
