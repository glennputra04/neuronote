<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QuizServices;

class QuizController extends Controller
{
    protected QuizServices $quizService;

    public function __construct(QuizServices $quizService)
    {
        $this->quizService = $quizService;
    }

    public function generate(Request $request)
    {
        $request->validate([
            'summary_file' => 'required|file|mimes:pdf'
        ]);

        $file = $request->file('summary_file');

        $quiz = $this->quizService->generateQuiz($file);

        $questions = $this->quizService->normalizeQuestions($quiz);
        
        session(['quiz_questions' => $questions]);
        
        return view('quiz', compact('questions'));
    }

   public function result(Request $request)
    {
        $questions = session('quiz_questions', []);

        $correctCount = 0;
        $incorrectCount = 0;

        $corrections = [];

        foreach ($questions as $question) {

            $userAnswerIndex = $request->input($question['name']);

            // kalau user belum jawab
            if ($userAnswerIndex === null) {

                $incorrectCount++;

                $corrections[] = [
                    'title' => $question['title'],
                    'text' => $question['text'],
                    'options' => $question['options'],
                    'user_answer' => null,
                    'correct_answer' => $question['answer'],
                ];

                continue;
            }

            $userAnswer = $question['options'][$userAnswerIndex] ?? '';

            $correctAnswer = $question['answer'];

            if ($userAnswer == $correctAnswer) {

                $correctCount++;

            } else {

                $incorrectCount++;

                $corrections[] = [
                    'title' => $question['title'],
                    'text' => $question['text'],
                    'options' => $question['options'],
                    'user_answer' => $userAnswer,
                    'correct_answer' => $correctAnswer,
                ];
            }
        }

        $total = count($questions);

        $percent = $total > 0
            ? round(($correctCount / $total) * 100)
            : 0;

        $isLowScore = $percent <= 60;

        return view('quiz-result', compact(
            'correctCount',
            'incorrectCount',
            'total',
            'percent',
            'isLowScore',
            'corrections'
        ));

    }

}
