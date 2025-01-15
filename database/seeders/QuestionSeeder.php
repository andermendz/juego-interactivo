<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            [
                'question' => '¿Cuál es el planeta más grande del sistema solar?',
                'option_a' => 'Marte',
                'option_b' => 'Júpiter',
                'option_c' => 'Saturno',
                'option_d' => 'Venus',
                'correct_answer' => 'b'
            ],
            [
                'question' => '¿En qué año se descubrió América?',
                'option_a' => '1492',
                'option_b' => '1489',
                'option_c' => '1495',
                'option_d' => '1500',
                'correct_answer' => 'a'
            ],
            [
                'question' => '¿Cuál es el elemento químico más abundante en el universo?',
                'option_a' => 'Oxígeno',
                'option_b' => 'Carbono',
                'option_c' => 'Hidrógeno',
                'option_d' => 'Helio',
                'correct_answer' => 'c'
            ],
            [
                'question' => '¿Quién pintó la Mona Lisa?',
                'option_a' => 'Miguel Ángel',
                'option_b' => 'Vincent van Gogh',
                'option_c' => 'Pablo Picasso',
                'option_d' => 'Leonardo da Vinci',
                'correct_answer' => 'd'
            ],
            [
                'question' => '¿Cuál es el océano más grande del mundo?',
                'option_a' => 'Océano Pacífico',
                'option_b' => 'Océano Atlántico',
                'option_c' => 'Océano Índico',
                'option_d' => 'Océano Ártico',
                'correct_answer' => 'a'
            ],
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
