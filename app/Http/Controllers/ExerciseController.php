<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExerciseController extends Controller
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
        $exercises = DB::table('exercises')
            ->where('user_id', '=', Auth::user()->id)
            ->orderBy('ex_descr')
            ->paginate(10);
        return view('exercise.index', compact('exercises'));
        //return view('exercise.index', ['exercises' => $exercises]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('create', Exercise::class)) {
            return view('exercise.create');
        }
        return redirect()->route('exercise.index')->withErrors('You are not allowed to create Exercise.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExerciseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExerciseRequest $request)
    {
        $exercise = new Exercise();
        $exercise->user_id = Auth::user()->id;
        $exercise->ex_descr = $request->ex_descr;
        $exercise->ex_type = $request->ex_type;

        $exercise->save();

        return redirect()->route('exercise.index')->with('success', 'Упражнение успешно добавлено');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function show(Exercise $exercise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercise $exercise)
    {
        if(Auth::user()->can('update', $exercise)) {
            return view('exercise.edit', compact('exercise'));
        }
        return redirect()->route('exercise.index')->withErrors('You are not allowed to edit Exercise.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExerciseRequest  $request
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExerciseRequest $request, Exercise $exercise)
    {
        if($exercise->user_id != Auth::user()->id) {
            return redirect()->route('exercise.index')->withErrors('Вы не можете редактировать данное упражнение');
        }
        $exercise->ex_descr = $request->ex_descr;
        $exercise->ex_type = $request->ex_type;
        $exercise->update();

        return redirect()->route('exercise.index')->with('success', 'Упражнение успешно изменено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercise $exercise)
    {
        if($exercise->user_id != Auth::user()->id) {
            return redirect()->route('exercise.index')->withErrors('Вы не можете удалить данное упражнение');
        }

        $exercise->delete();
        return redirect()->route('exercise.index')->with('success', 'Упражнение успешно удалено');
    }
}
