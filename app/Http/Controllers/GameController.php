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
            'answered_questions' => []
        ]);

        return redirect()->route('game.play');
    }

    public function play()
    {
        if (!session()->has('player_name')) {
            return redirect()->route('game.index');
        }

        // Check if game is finished
        if (session('questions_answered', 0) >= 5) {
            return redirect()->route('game.finish');
        }

        // Get random question excluding previously answered ones
        $answeredQuestions = session('answered_questions', []);
        $question = Question::whereNotIn('id', $answeredQuestions)
                          ->inRandomOrder()
                          ->first();

        if (!$question) {
            // If no more questions available, redirect to finish
            return redirect()->route('game.finish');
        }

        // Store answered question ID in session
        $answeredQuestions[] = $question->id;
        session(['answered_questions' => $answeredQuestions]);

        return view('game.play', compact('question'));
    }

    public function answer(Request $request)
    {
        if (!session()->has('player_name')) {
            return redirect()->route('game.index');
        }

        $question = Question::find($request->question_id);
        $correct = $question->correct_answer === $request->answer;

        // Update session score and answers count
        session()->increment('score', $correct ? 10 : 0);
        session()->increment('correct_answers', $correct ? 1 : 0);
        session()->increment('questions_answered', 1);

        // Check if game is finished (5 questions)
        if (session('questions_answered') >= 5) {
            // Save score
            Score::create([
                'player_name' => session('player_name'),
                'score' => session('score'),
                'correct_answers' => session('correct_answers'),
                'questions_answered' => 5 // Always 5 questions
            ]);

            return response()->json([
                'correct' => $correct,
                'correct_answer' => $question->correct_answer,
                'finished' => true
            ]);
        }

        return response()->json([
            'correct' => $correct,
            'correct_answer' => $question->correct_answer,
            'finished' => false
        ]);
    }

    public function finish()
    {
        if (!session()->has('player_name')) {
            return redirect()->route('game.index');
        }

        // Ensure we only show the finish page if all 5 questions were answered
        if (session('questions_answered', 0) < 5) {
            return redirect()->route('game.play');
        }

        $player_name = session('player_name');
        $score = session('score', 0);
        $correct_answers = session('correct_answers', 0);
        $questions_answered = 5; // Always 5 questions

        // Get top 10 scores
        $top_scores = Score::orderByDesc('score')
                          ->orderByDesc('correct_answers')
                          ->orderBy('questions_answered')
                          ->take(10)
                          ->get();

        // Clear game session
        session()->forget(['player_name', 'score', 'correct_answers', 'questions_answered', 'answered_questions']);

        return view('game.finish', compact('player_name', 'score', 'correct_answers', 'questions_answered', 'top_scores'));
    }
}
