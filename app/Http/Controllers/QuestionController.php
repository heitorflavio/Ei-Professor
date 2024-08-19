<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('question.index', [
            'questions' => Question::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View
    {
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request): \Illuminate\Http\RedirectResponse
    {
        $question = Question::create($request->validated());

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('question.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question): \Illuminate\Contracts\View\View
    {
        return view('question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question): \Illuminate\Http\RedirectResponse
    {
        $question->update($request->validated());

        return redirect()->route('question.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question): \Illuminate\Http\RedirectResponse
    {
        $question->delete();

        return redirect()->route('question.index');
    }
}
