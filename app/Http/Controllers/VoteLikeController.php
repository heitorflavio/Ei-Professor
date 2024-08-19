<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class VoteLikeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Question $question): \Illuminate\Http\RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $user->like($question);

        return back();
    }
}
