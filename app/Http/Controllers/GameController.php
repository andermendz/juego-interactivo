<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Score;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        if (!session()->has('player_name')) {
            return view('game.welcome');
        }
        return redirect()->route('game.play');
    }

    public function start(Request $request)
    {
        $request->validate([
            'player_name' => 'required|min:2|max:50'
        ]);

        session([
            'player_name' => $request->player_name,
            'score' => 0,
            'questions_answered' => 0,
            'correct_answers' => 0,
            'questions_ids' => Question::inRandomOrder()->pluck('id')->toArray()
        ]);

        return redirect()->route('game.play');
    }

    public function play()
    {
        if (!session()->has('player_name')) {
            return redirect()->route('game.index');
        }

        $questionIds = session('questions_ids', []);
        
        if (empty($questionIds) || session('questions_answered', 0) >= 5) {
            return redirect()->route('game.finish');
        }

        $currentQuestionId = array_shift($questionIds);
        session(['questions_ids' => $questionIds]);

        $question = Question::find($currentQuestionId);

        return view('game.play', compact('question'));
    }

    public function answer(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required|in:a,b,c,d'
        ]);

        $question = Question::find($request->question_id);
        $isCorrect = $question->correct_answer === $request->answer;

        if ($isCorrect) {
            session([
                'score' => session('score', 0) + 10,
                'correct_answers' => session('correct_answers', 0) + 1
            ]);
        }

        session([
            'questions_answered' => session('questions_answered', 0) + 1
        ]);

        return response()->json([
            'correct' => $isCorrect,
            'correct_answer' => $question->correct_answer
        ]);
    }

    public function finish()
    {
        if (!session()->has('player_name')) {
            return redirect()->route('game.index');
        }

        $score = new Score([
            'player_name' => session('player_name'),
            'score' => session('score', 0),
            'questions_answered' => session('questions_answered', 0),
            'correct_answers' => session('correct_answers', 0)
        ]);
        $score->save();

        $topScores = Score::orderBy('score', 'desc')
            ->take(10)
            ->get();

        $data = [
            'player_name' => session('player_name'),
            'score' => session('score', 0),
            'correct_answers' => session('correct_answers', 0),
            'questions_answered' => session('questions_answered', 0),
            'top_scores' => $topScores
        ];

        session()->forget([
            'player_name',
            'score',
            'questions_answered',
            'correct_answers',
            'questions_ids'
        ]);

        return view('game.finish', $data);
    }
}
