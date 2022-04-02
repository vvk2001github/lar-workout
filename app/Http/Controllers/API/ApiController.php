<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use App\Models\Exercise;
use App\Models\User;
use App\Models\Workout;
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

    ##
    ##Workouts
    ##

    public function workoutsIndex(Request $request): JsonResponse
    {
        $sortOrder = $request->input('sortOrder', 'desc');
        $fltExercise = $request->input('fltExercise', 0);
        $limit = $request->input('limit', 5);
        $offset = $request->input('offset', 0);
        $offset = $offset * $limit;

        $workouts = DB::table('workouts')
            ->join('exercises', 'workouts.ex_id', '=', 'exercises.ex_id')
            ->where('exercises.user_id', '=', Auth::user()->id);


        if($fltExercise > 0) $workouts = $workouts->where('exercises.ex_id', '=', $fltExercise);


        $workouts = $workouts->orderBy('workouts.created_at', $sortOrder)
            ->limit($limit)
            ->offset($offset)
            ->get(['workouts.w_id', 'workouts.created_at', 'exercises.ex_descr', 'workouts.count1', 'workouts.count2', 'workouts.weight1', 'workouts.weight2']);

        $count = DB::table('workouts')
            ->join('exercises', 'workouts.ex_id', '=', 'exercises.ex_id')
            ->where('exercises.user_id', '=', Auth::user()->id);
        if($fltExercise > 0) $count = $count->where('exercises.ex_id', '=', $fltExercise);
        $count = $count->count();

        // Упражнения, которые хоть раз использовались в тренировках
        $usedExercises = DB::table('exercises')
            ->join('workouts', 'exercises.ex_id', '=', 'workouts.ex_id')
            ->join('users', 'exercises.user_id', '=', 'users.id')
            ->where('users.id', '=', Auth::user()->id)
            ->select('exercises.ex_id', 'exercises.ex_descr')
            ->distinct()
            ->orderBy('exercises.ex_descr')->get();

        $exercises = DB::table('exercises')
            ->where('user_id', Auth::user()->id)
            ->orderBy('ex_descr')
            ->get();

        return response()->json(compact('workouts', 'usedExercises', 'fltExercise', 'count', 'exercises'));
    }
}
