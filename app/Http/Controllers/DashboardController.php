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
        // Fetch data from models
        $peopleCount = Person::count();
        $businessCount = Business::count();
        $noteCount = Note::count();
        $taskCount = Task::count();
        $categoryCount = Tag::count();

        $statisticsByDay = $this->getStatisticsByDay();
        $statisticsByWeek = $this->getStatisticsByWeek();
        $statisticsByMonth = $this->getStatisticsByMonth();
        $statisticsByYear = $this->getStatisticsByYear();

        return view('dashboard', compact('peopleCount', 'businessCount', 'noteCount', 'taskCount', 'categoryCount',
                                        'statisticsByDay', 'statisticsByWeek', 'statisticsByMonth', 'statisticsByYear'));
    }

    private function getStatisticsByDay()
    {
        $createdPersons = Person::where('created_at', '>', Carbon::now()->subDay())->count();
        $createdBusinesses = Business::where('created_at', '>', Carbon::now()->subDay())->count();
        $createdNotes = Note::where('created_at', '>', Carbon::now()->subDay())->count();
        $createdTasks = Task::where('created_at', '>', Carbon::now()->subDay())->count();
        $createdCategories = Tag::where('created_at', '>', Carbon::now()->subDay())->count();

        return compact('createdPersons', 'createdBusinesses', 'createdNotes', 'createdTasks', 'createdCategories');
    }

    private function getStatisticsByWeek()
    {
        $createdPersons = Person::where('created_at', '>', Carbon::now()->subWeek())->count();
        $createdBusinesses = Business::where('created_at', '>', Carbon::now()->subWeek())->count();
        $createdNotes = Note::where('created_at', '>', Carbon::now()->subWeek())->count();
        $createdTasks = Task::where('created_at', '>', Carbon::now()->subWeek())->count();
        $createdCategories = Tag::where('created_at', '>', Carbon::now()->subWeek())->count();

        return compact('createdPersons', 'createdBusinesses', 'createdNotes', 'createdTasks', 'createdCategories');
    }

    private function getStatisticsByMonth()
    {
        $createdPersons = Person::where('created_at', '>', Carbon::now()->subMonth())->count();
        $createdBusinesses = Business::where('created_at', '>', Carbon::now()->subMonth())->count();
        $createdNotes = Note::where('created_at', '>', Carbon::now()->subMonth())->count();
        $createdTasks = Task::where('created_at', '>', Carbon::now()->subMonth())->count();
        $createdCategories = Tag::where('created_at', '>', Carbon::now()->subMonth())->count();

        return compact('createdPersons', 'createdBusinesses', 'createdNotes', 'createdTasks', 'createdCategories');
    }

    private function getStatisticsByYear()
    {
        $createdPersons = Person::where('created_at', '>', Carbon::now()->subYear())->count();
        $createdBusinesses = Business::where('created_at', '>', Carbon::now()->subYear())->count();
        $createdNotes = Note::where('created_at', '>', Carbon::now()->subYear())->count();
        $createdTasks = Task::where('created_at', '>', Carbon::now()->subYear())->count();
        $createdCategories = Tag::where('created_at', '>', Carbon::now()->subYear())->count();

        return compact('createdPersons', 'createdBusinesses', 'createdNotes', 'createdTasks', 'createdCategories');
    }
}
