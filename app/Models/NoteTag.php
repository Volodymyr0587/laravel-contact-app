<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoteTag extends Model
{
    use HasFactory; //, SoftDeletes;

    protected $fillable = ['tag_name'];

    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class, 'tag_has_note');
    }
}
