<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): \Illuminate\Contracts\View\View
    {
        return view(
            'dashboard',
            [
                'questions' => Question::withSum('votes', 'like')->withSum('votes', 'unlike')->paginate(12),
            ]
        );
    }
}
