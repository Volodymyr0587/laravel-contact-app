<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BusinessCategory extends Model
{
    use HasFactory;

    public $fillable = ['category_name'];

    public function business(): BelongsToMany
    {
        return $this->belongsToMany(Business::class, 'category_has_business');
    }
}
