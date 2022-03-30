<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
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
     * @return Response
     */
    public function index()
    {
        $exercises = Auth::user()->exercises()->orderBy('ex_descr')->paginate(10);
        return view('exercise.index', compact('exercises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
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
     * @return Response
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
     * @param Exercise $exercise
     * @return Response
     */
    public function show(Exercise $exercise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Exercise $exercise
     * @return Response
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
     * @param UpdateExerciseRequest $request
     * @param Exercise $exercise
     * @return RedirectResponse
     */
    public function update(UpdateExerciseRequest $request, Exercise $exercise): RedirectResponse
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
     * @param Exercise $exercise
     * @return RedirectResponse
     */
    public function destroy(Exercise $exercise): RedirectResponse
    {
        if($exercise->user_id != Auth::user()->id) {
            return redirect()->route('exercise.index')->withErrors('Вы не можете удалить данное упражнение');
        }

        $exercise->delete();
        return redirect()->route('exercise.index')->with('success', 'Упражнение успешно удалено');
    }
}
