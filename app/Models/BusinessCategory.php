<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BusinessCategory extends Model
{
    use HasFactory; //, SoftDeletes;

    public $fillable = ['user_id', 'category_name'];

    public function business(): BelongsToMany
    {
        return $this->belongsToMany(Business::class, 'category_has_business');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
