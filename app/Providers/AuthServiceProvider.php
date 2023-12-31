<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Business;
use App\Models\BusinessCategory;
use App\Models\Note;
use App\Models\Person;
use App\Models\Tag;
use App\Policies\BusinessCategoryPolicy;
use App\Policies\BusinessPolicy;
use App\Policies\NotePolicy;
use App\Policies\PersonPolicy;
use App\Policies\TagPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Note::class => NotePolicy::class,
        Person::class => PersonPolicy::class,
        Business::class => BusinessPolicy::class,
        BusinessCategory::class => BusinessCategoryPolicy::class,
        Tag::class => TagPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
