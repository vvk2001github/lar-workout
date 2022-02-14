<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Workout;
use App\Http\Requests\StoreWorkoutRequest;
use App\Http\Requests\UpdateWorkoutRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $workouts = DB::table('workouts')
//            ->join('exercises', 'exercises.ex_id', '=', 'workouts.ex_id')
//            ->join('users', 'exercises.user_id', '=', 'users.id')
//            ->where('users.id', '=', Auth::user()->id)
//            ->orderBy('workouts.created_at')
//            ->paginate(10);
//        $workouts = Workout::whereHas('exercise', function ($q) {
//            $q->where('user_id', '=', Auth::user()->id);
//        })
//            ->orderBy('created_at', 'desc')
//            ->paginate(10);
        $workouts = Workout::whereRelation('exercise', 'user_id', '=', Auth::user()->id)
            ->orderBy('created_at', 'desc')->paginate(10);
        return view('workout.index', compact('workouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('create', Workout::class)) {
            return redirect()->route('workout.index')->withErrors('You are not allowed to create Workout.');
        }

//        $exercises = DB::table('exercises')
//            ->select(['ex_id', 'ex_descr', 'ex_type'])
//            ->where('user_id', '=', Auth::user()->id)
//            ->orderBy('ex_descr')
//            ->get();

        $exercises = Auth::user()->exercises()->orderBy('ex_descr')->get();

        return view('workout.create', compact('exercises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkoutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkoutRequest $request)
    {
        if (!Auth::user()->can('create', Workout::class)) {
            return redirect()->route('workout.index')->withErrors('You are not allowed to create Workout.');
        }

        $workout = new Workout();
        $workout->ex_id = $request->ex_id;
        $workout->weight1 = $request->weight1;
        $workout->count1 = $request->count1;
        $workout->weight2 = $request->weight2;
        $workout->count2 = $request->count2;

        $workout->save();

        return redirect()->route('workout.index')->with('success', 'Тренировка успешно добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function show(Workout $workout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function edit(Workout $workout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkoutRequest  $request
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkoutRequest $request, Workout $workout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workout $workout)
    {
        if($workout->exercise->user_id != Auth::user()->id) {
            return redirect()->route('workout.index')->withErrors('Вы не можете удалить данную тренировку');
        }

        ;$workout->delete();
        return redirect()->route('workout.index')->with('success', 'Тренировка успешно удалена');
    }
}
