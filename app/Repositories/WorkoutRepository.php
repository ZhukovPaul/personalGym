<?

namespace App\Repositories;

use App\Contracts\Repositories\Repository;
use App\Models\{WorkoutSection, Workout};
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class WorkoutRepository implements Repository
{
    protected $section ; 

    public function __construct()
    {
        $this->section = WorkoutSection::all() ;
    }

    public function all()
    {
        /*
        $workouts  = collect([]);
      
        foreach($this->section as $section){
            if($section->workouts)
                $workouts = $workouts->merge($section->workouts->all());
        }
        */
        return $this->section;
    }
}
