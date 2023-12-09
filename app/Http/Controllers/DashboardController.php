<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Note;
use App\Models\Person;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        //Get auth user
        $user = auth()->user();

        // Fetch data from models
        $peopleCount = $user->people()->count();
        $businessCount = $user->businesses()->count();
        $businessCategoriesCount = $user->businessCategories()->count();
        $noteCount = $user->notes()->count();
        $taskCount = $user->tasks()->count();
        $categoryCount = $user->tags()->count();

        $statisticsByDay = $this->getStatisticsByDay();
        $statisticsByWeek = $this->getStatisticsByWeek();
        $statisticsByMonth = $this->getStatisticsByMonth();
        $statisticsByYear = $this->getStatisticsByYear();

        return view('dashboard', compact('peopleCount', 'businessCount', 'businessCategoriesCount', 'noteCount', 'taskCount', 'categoryCount',
                                        'statisticsByDay', 'statisticsByWeek', 'statisticsByMonth', 'statisticsByYear'));
    }

    private function getStatisticsByDay()
    {
        //Get auth user
        $user = auth()->user();

        $createdPersons = $user->people()->where('created_at', '>', Carbon::now()->subDay())->count();
        $createdBusinesses = $user->businesses()->where('created_at', '>', Carbon::now()->subDay())->count();
        $createdBusinessCategories = $user->businessCategories()->where('created_at', '>', Carbon::now()->subDay())->count();
        $createdNotes = $user->notes()->where('created_at', '>', Carbon::now()->subDay())->count();
        $createdTasks = $user->tasks()->where('created_at', '>', Carbon::now()->subDay())->count();
        $createdCategories = $user->tags()->where('created_at', '>', Carbon::now()->subDay())->count();

        return compact('createdPersons', 'createdBusinesses', 'createdBusinessCategories', 'createdNotes', 'createdTasks', 'createdCategories');
    }

    private function getStatisticsByWeek()
    {
        //Get auth user
        $user = auth()->user();

        $createdPersons = $user->people()->where('created_at', '>', Carbon::now()->subWeek())->count();
        $createdBusinesses = $user->businesses()->where('created_at', '>', Carbon::now()->subWeek())->count();
        $createdBusinessCategories = $user->businessCategories()->where('created_at', '>', Carbon::now()->subWeek())->count();
        $createdNotes = $user->notes()->where('created_at', '>', Carbon::now()->subWeek())->count();
        $createdTasks = $user->tasks()->where('created_at', '>', Carbon::now()->subWeek())->count();
        $createdCategories = $user->tags()->where('created_at', '>', Carbon::now()->subWeek())->count();

        return compact('createdPersons', 'createdBusinesses', 'createdBusinessCategories', 'createdNotes', 'createdTasks', 'createdCategories');
    }

    private function getStatisticsByMonth()
    {
        //Get auth user
        $user = auth()->user();

        $createdPersons = $user->people()->where('created_at', '>', Carbon::now()->subMonth())->count();
        $createdBusinesses = $user->businesses()->where('created_at', '>', Carbon::now()->subMonth())->count();
        $createdBusinessCategories = $user->businessCategories()->where('created_at', '>', Carbon::now()->subMonth())->count();
        $createdNotes = $user->notes()->where('created_at', '>', Carbon::now()->subMonth())->count();
        $createdTasks = $user->tasks()->where('created_at', '>', Carbon::now()->subMonth())->count();
        $createdCategories = $user->tags()->where('created_at', '>', Carbon::now()->subMonth())->count();

        return compact('createdPersons', 'createdBusinesses', 'createdBusinessCategories', 'createdNotes', 'createdTasks', 'createdCategories');
    }

    private function getStatisticsByYear()
    {
        //Get auth user
        $user = auth()->user();

        $createdPersons = $user->people()->where('created_at', '>', Carbon::now()->subYear())->count();
        $createdBusinesses = $user->businesses()->where('created_at', '>', Carbon::now()->subYear())->count();
        $createdBusinessCategories = $user->businessCategories()->where('created_at', '>', Carbon::now()->subYear())->count();
        $createdNotes = $user->notes()->where('created_at', '>', Carbon::now()->subYear())->count();
        $createdTasks = $user->tasks()->where('created_at', '>', Carbon::now()->subYear())->count();
        $createdCategories = $user->tags()->where('created_at', '>', Carbon::now()->subYear())->count();

        return compact('createdPersons', 'createdBusinesses', 'createdBusinessCategories', 'createdNotes', 'createdTasks', 'createdCategories');
    }
}
