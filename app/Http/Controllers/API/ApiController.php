<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use App\Models\Exercise;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    use ApiResponser;

    #
    # Exercises
    #
    public function exerciseIndex(): JsonResponse
    {
        $exercises = DB::table('exercises')
            ->where('user_id', Auth::user()->id)
            ->orderBy('ex_descr')->get();
        return response()->json($exercises);
    }

    public function exerciseStore(StoreExerciseRequest $request): JsonResponse
    {
        /**
         * @var Exercise $exercise
         */
        $exercise = new Exercise();
        $exercise->user_id = Auth::user()->id;
        $exercise->ex_descr = $request->input('ex_descr');
        $exercise->ex_type = $request->input('ex_type');

        $exercise->save();

        return $this->apisuccess(null, "Exercise added");
    }

    public function exerciseUpdate(UpdateExerciseRequest $request): JsonResponse
    {
        $exercise = Exercise::findOrFail($request->input('ex_id'));
        if(!isset($exercise)) return $this->apierror('You can not edit this exercise', 404);
        if($exercise->user_id != Auth::user()->id) {
            return $this->apierror('You can not edit this exercise', 404);
        }
        $exercise->ex_descr = $request->input('ex_descr');
        $exercise->ex_type = $request->input('ex_type');
        $exercise->update();

        return $this->apisuccess(null, "Exercise updated");
    }

    public function exerciseDestroy(Request $request): JsonResponse
    {
        $exercise = Exercise::findOrFail($request->input('ex_id'));
        if(!isset($exercise)) return $this->apierror('You can not delete this exercise', 404);
        if($exercise->user_id != Auth::user()->id) {
            return $this->apierror('You can not delete this exercise', 404);
        }

        $exercise->delete();
        return $this->apisuccess(null, 'Exercises deleted');
    }

    public function exercisesData(Request $request): JsonResponse
    {
        if($request->exists('ex_id')) {
            $workouts = DB::table('workouts')
                ->where('ex_id', '=', $request->input('ex_id'))
                ->orderBy('created_at')
                ->get();
            return $this->apisuccess($workouts, "Success");
        } else {
            return $this->apierror( 'ex_id needed', 400);
        }
    }

    public function exercisesList(Request $request): JsonResponse
    {
        if($request->exists('ex_type')) {
            $exercises = DB::table('exercises')
                ->where('user_id', Auth::user()->id)
                ->where('ex_type', '=', $request->input('ex_type'))
                ->orderBy('ex_descr')->get();
            return $this->apisuccess($exercises, "Success");
        } else {
            return $this->apierror('ex_type needed', 400);
        }

    }

    public function me(): JsonResponse
    {
        $data = Auth::user();
        return response()->json($data);
    }

    public function userList(Request $request): JsonResponse
    {
        if($request->user()->tokenCan('server-admin')) {
            $users = User::all();
            return $this->apisuccess($users);
        } else {
            return $this->apierror('Credentials not match', 401);
        }
    }
}
