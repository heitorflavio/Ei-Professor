<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Question $question): \Illuminate\Http\RedirectResponse
    {
        auth()->user()->like($question);

        return redirect()->route('dashboard');
    }
}
