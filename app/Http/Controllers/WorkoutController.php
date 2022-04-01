<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Workout;
use App\Http\Requests\StoreWorkoutRequest;
use App\Http\Requests\UpdateWorkoutRequest;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        $fltExercise = 0;
        $srtDate = 0;
        $direction = 'desc';
        $page = 1;

        if(isset($request->page)) $page = $request->page;

        if(isset($request->srtDate) && ($request->srtDate == 1)) { $srtDate = 1; $direction = 'asc'; } else { $srtDate = 0; };

        if(isset($request->fltExercise)) $fltExercise = $request->fltExercise;
        $workouts = Workout::whereRelation('exercise', 'user_id', '=', Auth::user()->id);

        if($fltExercise > 0) $workouts = $workouts->where('ex_id', '=', $fltExercise);

        $workouts = $workouts->orderBy('created_at', $direction)->paginate(5)->appends(['fltExercise' => $fltExercise, 'srtDate' => $srtDate]);

        // Управжнения, которые хоть раз использовались в тренировках
        $usedExercises = DB::table('exercises')
            ->join('workouts', 'exercises.ex_id', '=', 'workouts.ex_id')
            ->join('users', 'exercises.user_id', '=', 'users.id')
            ->where('users.id', '=', Auth::user()->id)
            ->select('exercises.ex_id', 'exercises.ex_descr')
            ->distinct()
            ->orderBy('exercises.ex_descr')->get();

        return view('workout.index', compact('workouts', 'usedExercises', 'fltExercise', 'srtDate', 'page'));
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

        $exercise = Exercise::find($request->ex_id);
        if($exercise->ex_type == 0) {$workout->weight1 =0; $workout->count2 = 0; $workout->weight2 = 0;};
        if($exercise->ex_type == 1) {$workout->weight1 =0; $workout->weight2 = 0;};
        if($exercise->ex_type == 2) {$workout->count2 = 0; $workout->weight2 = 0;};

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
        if(Auth::user()->can('update', $workout)) {
            $exercises = Auth::user()->exercises()->orderBy('ex_descr')->get();
            return view('workout.edit', compact(['workout', 'exercises']));
        }
        return redirect()->route('workout.index')->withErrors('You are not allowed to edit Workout.');
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
        if($workout->exercise->user_id != Auth::user()->id) {
            return redirect()->route('exercise.index')->withErrors('Вы не можете редактировать данную тренировку');
        }

        $workout->ex_id = $request->ex_id;
        $workout->weight1 = $request->weight1;
        $workout->count1 = $request->count1;
        $workout->weight2 = $request->weight2;
        $workout->count2 = $request->count2;

        $exercise = Exercise::find($request->ex_id);
        if($exercise->ex_type == 0) {$workout->weight1 =0; $workout->count2 = 0; $workout->weight2 = 0;};
        if($exercise->ex_type == 1) {$workout->weight1 =0; $workout->weight2 = 0;};
        if($exercise->ex_type == 2) {$workout->count2 = 0; $workout->weight2 = 0;};

        $workout->update();

        return redirect()->route('workout.index')->with('success', 'Тренировка успешно изменена');
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
