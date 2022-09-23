<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\Repository;
use App\Events\WorkoutAdding;
use App\Models\{WorkoutImage, WorkoutSection};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkoutSectionController extends Controller
{
    protected $repository;

    function __construct(Repository $repository)
    {
        $this->repository = $repository;
        $this->middleware('auth');
    }

    public function index()
    {
        $sections = $this->repository
            ->all()
            ->where("workout_section_id", null)
            ->all();

        foreach ($sections as $key => $section) {

            if ($section->image) {
                $sections[$key]["image"] = \Thumbnail::src(
                    env('APP_URL') . '/storage/' . $section->image->path)
                    ->smartcrop(300, 220)
                    ->url(true);
            }
        }

        return view("workout.index", ["sections" => $sections]);
    }

    public function create()
    {
        $sections = $this->repository->all();
        $sectAll = [0 => null];

        foreach ($sections as $value) {
            $sectAll[$value["id"]] = $value["title"];
        }

        return view("workout.section.create", ["sections" => $sectAll]);
    }

    public function store(Request $request)
    {
        $validate_rules = [
            "title" => "required|max:50|unique:workout_sections",
            "file" => "image"
        ];

        $request->validate($validate_rules);

        $fields = $request->only("title", "slug", "description", "file");

        $workoutSection = WorkoutSection::create([
            "title" => $fields["title"],
            "slug" => ($fields["slug"])
                ? \Illuminate\Support\Str::slug($fields["slug"], "_")
                : \Illuminate\Support\Str::slug($fields["title"], "_"),
            "description" => $fields["description"],
        ]);

        if ($request->hasFile("file")) {
            WorkoutImage::uploadImage($request->file("file"), $workoutSection);
        }

        return redirect()->route("workout.index");
    }

    public function show(WorkoutSection $workoutSection)
    {
        $el = resolve(Repository::class);
        $sections = $workoutSection->sections;

        foreach ($sections as $key => $section) {
            if ($section->image) {
                $sections[$key]["image"] = \Thumbnail::src(
                    env('APP_URL') . '/storage/' . $section->image->path)
                    ->smartcrop(300, 220)
                    ->url(true);
            }
        }

        $workouts = $workoutSection->workouts;

        foreach ($workouts as $key => $workout) {
            if ($workout->image)
                $workouts[$key]["image"] = \Thumbnail::src(
                    env('APP_URL') . '/storage/' . $workout->image->path)
                    ->smartcrop(300, 220)
                    ->url(true);
        }

        return view("workout.section.index", [
            "section" => $workoutSection,
            "workouts" => $workouts,
            "sections" => $sections
        ]);
    }

    public function edit(WorkoutSection $workoutSection)
    {
        $sections = WorkoutSection::all("id", "title");
        $sectAll = [0 => null];
        foreach ($sections as $value) {
            $sectAll[$value["id"]] = $value["title"];
        }

        return view("workout.section.edit", [
            "workout" => $workoutSection,
            "sections" => $sectAll
        ]);
    }

    public function update(Request $request, WorkoutSection $workoutSection)
    {
        $validate_rules = [
            "title" => "required|max:50",
            "file" => "image"
        ];

        $request->validate($validate_rules);
        $fields = $request->only(["title", "slug", "description", "file"]);

        $workoutSection->update([
            "title" => $fields["title"],
            "slug" => ($fields["slug"])
                ? Str::slug($fields["slug"], "_")
                : Str::slug($fields["title"], "_"),
            "description" => $fields["description"],
        ]);

        if ($request->hasFile("file")) {

            if ($workoutSection->image) {
                Storage::delete($workoutSection->image->path);
                $workoutSection->image->delete();
            }

            WorkoutImage::uploadImage(
                $request->file("file"),
                $workoutSection
            );
        }

        return redirect()->route("workout.index");
    }

    public function destroy(WorkoutSection $workoutSection)
    {
        if ($workoutSection->image) {
            $workoutSection->image->delete();
        }

        $workoutSection->delete();

        return redirect()->route("workout.index");
    }
}
