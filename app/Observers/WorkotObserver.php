<?php

namespace App\Observers;

use App\Models\Workout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WorkotObserver
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Handle the Workout "created" event.
     *
     * @param  Workout  $workout
     * @return void
     */
    public function created(Workout $workout)
    {
        Storage::disk('public')->append('system.log', 'User #ID' . $this->user->id . ' add new workout #ID' . $workout->id . " '" . $workout->title . "' " . date('d.m.Y H:i:s'));
    }

    /**
     * Handle the Workout "updated" event.
     *
     * @param  Workout  $workout
     * @return void
     */
    public function updated(Workout $workout)
    {
        Storage::disk('public')->append('system.log', 'User #ID' . $this->user->id . ' update  workout #ID' . $workout->id . " '" . $workout->title . "' " . date('d.m.Y H:i:s'));
    }

    /**
     * Handle the Workout "deleted" event.
     *
     * @param  Workout  $workout
     * @return void
     */
    public function deleted(Workout $workout)
    {
        Storage::disk('public')->append('system.log', 'User #ID' . $this->user->id . ' delete workout #ID' . $workout->id . " '" . $workout->title . "' " . date('d.m.Y H:i:s'));
    }

    /**
     * Handle the Workout "restored" event.
     *
     * @param  Workout  $workout
     * @return void
     */
    public function restored(Workout $workout)
    {
        //
    }

    /**
     * Handle the Workout "force deleted" event.
     *
     * @param  Workout  $workout
     * @return void
     */
    public function forceDeleted(Workout $workout)
    {
        //
    }
}
