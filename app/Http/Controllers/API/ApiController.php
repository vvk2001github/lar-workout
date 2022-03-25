<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
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
    public function exerciseIndex(): \Illuminate\Http\JsonResponse
    {
        $exercises = DB::table('exercises')
            ->where('user_id', Auth::user()->id)
            ->orderBy('ex_descr')->get();
        return response()->json($exercises, 200);
    }

    public function exercisesData(Request $request): \Illuminate\Http\JsonResponse
    {
        if($request->exists('ex_id')) {
            $workouts = DB::table('workouts')
                ->where('ex_id', '=', $request->ex_id)
                ->orderBy('created_at', 'asc')
                ->get();
            return $this->apisuccess($data = $workouts, $message="Success");
        } else {
            return $this->apierror($message = 'ex_id needed', 400);
        }
    }

    public function exercisesList(Request $request): \Illuminate\Http\JsonResponse
    {
        if($request->exists('ex_type')) {
            $exercises = DB::table('exercises')
                ->where('user_id', Auth::user()->id)
                ->where('ex_type', '=', $request->ex_type)
                ->orderBy('ex_descr')->get();
            return $this->apisuccess($data = $exercises, $message="Success");
        } else {
            return $this->apierror($message = 'ex_type needed', 400);
        }

    }

    public function me(): \Illuminate\Http\JsonResponse
    {
        $data = Auth::user();
        return response()->json($data, 200);
    }

    public function userList(Request $request): \Illuminate\Http\JsonResponse
    {
        if($request->user()->tokenCan('server-admin')) {
            $users = \App\Models\User::all();
            return $this->apisuccess($users);
        } else {
            return $this->apierror('Credentials not match', 401);
        }
    }
}
