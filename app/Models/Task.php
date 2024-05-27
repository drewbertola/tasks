<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Task extends Model
{
    use HasFactory, Searchable;

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

    /**
    * Get the indexable data array for the model.
    *
    * @return array<string, mixed>
    */
    public function toSearchableArray()
    {
        return [
            'id' => (string) $this->id,
            'task' => $this->task,
            'owner' => $this->owner->name,
            'author' => $this->author->name,
            'created_at' => $this->created_at->timestamp,
        ];
    }

}
