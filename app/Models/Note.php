<?php

namespace App\Models;

use App\Models\NoteTag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'body',
        'is_active',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(NoteTag::class, 'tag_has_note');
    }
}
