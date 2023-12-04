<?php

namespace App\Models;

use App\Models\NoteTag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'image',
        'body',
        'is_active',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(NoteTag::class, 'tag_has_note');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
