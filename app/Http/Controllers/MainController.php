<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function dashboard()
    {
        $quizzes = Quiz::where('status', 'publish')
            ->withCount('questions')
            ->paginate(5);

        return view('dashboard', compact('quizzes'));
    }

    public function quiz_detail(string $slug)
    {
        $quiz = Quiz::whereSlug($slug)->withCount('questions')->first() ?? abort(404, 'Quiz bulunamadı');

        return view('quiz_detail', compact('quiz'));
    }
    public function quiz($slug)
    {
        $quiz = Quiz::whereSlug($slug)->with('questions')->first();
        return view('quiz', compact('quiz'));
    }
}
