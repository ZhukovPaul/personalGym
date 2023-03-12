<?php

namespace App\Observers;

use App\Models\WorkoutSection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WorkoutSectionObserver
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function created(WorkoutSection $workoutSection)
    {
        Storage::disk('public')->append('system.log', 'User #ID' . $this->user?->id . ' add new section #ID' . $workoutSection->id . " '" . $workoutSection->title . "' " . date('d.m.Y H:i:s'));
    }

    /**
     * Handle the WorkoutSection "updated" event.
     *
     * @param  WorkoutSection  $workoutSection
     * @return void
     */
    public function updated(WorkoutSection $workoutSection)
    {
        //
        Storage::disk('public')->append('system.log', 'User #ID' . $this->user->id . ' update  section #ID' . $workoutSection->id . " '" . $workoutSection->title . "' " . date('d.m.Y H:i:s'));
    }

    /**
     * Handle the WorkoutSection "deleted" event.
     *
     * @param  WorkoutSection  $workoutSection
     * @return void
     */
    public function deleted(WorkoutSection $workoutSection)
    {
        Storage::disk('public')->append('system.log', 'User #ID' . $this->user->id . ' delete section #ID' . $workoutSection->id . " '" . $workoutSection->title . "' " . date('d.m.Y H:i:s'));
    }

    /**
     * Handle the WorkoutSection "restored" event.
     *
     * @param  WorkoutSection  $workoutSection
     * @return void
     */
    public function restored(WorkoutSection $workoutSection)
    {
        //
    }

    /**
     * Handle the WorkoutSection "force deleted" event.
     *
     * @param  WorkoutSection  $workoutSection
     * @return void
     */
    public function forceDeleted(WorkoutSection $workoutSection)
    {
        //
    }
}
