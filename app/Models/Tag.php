<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory; //, SoftDeletes;

    protected $fillable = ['user_id', 'tag_name', 'color'];

    public function people(): MorphToMany
    {
        return $this->morphedByMany(Person::class, 'taggable');
    }

    public function businesses(): MorphToMany
    {
        return $this->morphedByMany(Business::class, 'taggable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
