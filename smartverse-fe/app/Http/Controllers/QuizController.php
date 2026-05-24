<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function quiz()
    {
        $questions = [
            [
                'title' => 'Question 1',
                'text' => 'What is Lorem Ipsum?',
                'name' => 'q1',
                'options' => [
                    'Option 1',
                    'Option 2',
                    'Option 3',
                    'Option 4',
                ],
            ],
            [
                'title' => 'Question 2',
                'text' => 'Who is Lorem Ipsum?',
                'name' => 'q2',
                'options' => [
                    'Option 1',
                    'Option 2',
                    'Option 3',
                    'Option 4',
                ],
            ],
            [
                'title' => 'Question 3',
                'text' => 'Where is Lorem Ipsum?',
                'name' => 'q3',
                'options' => [
                    'Option 1',
                    'Option 2',
                    'Option 3',
                    'Option 4',
                ],
            ],
            [
                'title' => 'Question 4',
                'text' => 'Why is Lorem Ipsum?',
                'name' => 'q4',
                'options' => [
                    'Option 1',
                    'Option 2',
                    'Option 3',
                    'Option 4',
                ],
            ],
            [
                'title' => 'Question 5',
                'text' => 'When is Lorem Ipsum?',
                'name' => 'q5',
                'options' => [
                    'Option 1',
                    'Option 2',
                    'Option 3',
                    'Option 4',
                ],
            ],
        ];

        return view('quiz', compact('questions'));
    }

    public function result()
    {
        $correctCount = 3;
        $incorrectCount = 2;
        $total = 5;
        $percent = 60;
        $isLowScore = $percent <= 60;

        $corrections = [
            [
                'title' => 'Question 1',
                'text' => 'What is Lorem Ipsum?',
                'options' => ['Option 1', 'Option 2', 'Option 3', 'Option 4'],
                'user_answer' => 0,
                'correct_answer' => 3,
            ],
            [
                'title' => 'Question 3',
                'text' => 'Where is Lorem Ipsum?',
                'options' => ['Option 1', 'Option 2', 'Option 3', 'Option 4'],
                'user_answer' => 0,
                'correct_answer' => 1,
            ],
        ];

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
