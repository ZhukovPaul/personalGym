<?php

namespace App\Repositories;

use App\Contracts\Repositories\Repository;
use App\Models\WorkoutSection;

class WorkoutSectionRepository implements Repository
{
    protected $section;

    public function __construct()
    {
        $this->section = WorkoutSection::all();
    }

    public function all()
    {
        return $this->section;
    }

    public function workouts()
    {
        $workouts = collect([]);

        foreach ($this->section as $section) {
            if ($section->workouts) {
                $workouts = $workouts->merge($section->workouts->all());
            }
        }

        return $workouts;
    }
}
