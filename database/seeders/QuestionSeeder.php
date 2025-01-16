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
            [
                'question' => '¿Cuál es el hueso más largo del cuerpo humano?',
                'option_a' => 'Húmero',
                'option_b' => 'Fémur',
                'option_c' => 'Tibia',
                'option_d' => 'Radio',
                'correct_answer' => 'b'
            ],
            [
                'question' => '¿En qué país se encuentra la Torre Eiffel?',
                'option_a' => 'Italia',
                'option_b' => 'España',
                'option_c' => 'Francia',
                'option_d' => 'Alemania',
                'correct_answer' => 'c'
            ],
            [
                'question' => '¿Cuál es el río más largo del mundo?',
                'option_a' => 'Nilo',
                'option_b' => 'Amazonas',
                'option_c' => 'Yangtsé',
                'option_d' => 'Misisipi',
                'correct_answer' => 'b'
            ],
            [
                'question' => '¿Quién escribió "Don Quijote de la Mancha"?',
                'option_a' => 'Miguel de Cervantes',
                'option_b' => 'Federico García Lorca',
                'option_c' => 'Gabriel García Márquez',
                'option_d' => 'Pablo Neruda',
                'correct_answer' => 'a'
            ],
            [
                'question' => '¿Cuál es el metal más precioso?',
                'option_a' => 'Oro',
                'option_b' => 'Plata',
                'option_c' => 'Platino',
                'option_d' => 'Rodio',
                'correct_answer' => 'd'
            ],
            [
                'question' => '¿En qué año comenzó la Primera Guerra Mundial?',
                'option_a' => '1913',
                'option_b' => '1914',
                'option_c' => '1915',
                'option_d' => '1916',
                'correct_answer' => 'b'
            ],
            [
                'question' => '¿Cuál es el país más poblado del mundo?',
                'option_a' => 'Estados Unidos',
                'option_b' => 'India',
                'option_c' => 'China',
                'option_d' => 'Rusia',
                'correct_answer' => 'b'
            ],
            [
                'question' => '¿Quién fue el primer ser humano en pisar la Luna?',
                'option_a' => 'Buzz Aldrin',
                'option_b' => 'Yuri Gagarin',
                'option_c' => 'Neil Armstrong',
                'option_d' => 'John Glenn',
                'correct_answer' => 'c'
            ],
            [
                'question' => '¿Cuál es la capital de Australia?',
                'option_a' => 'Sídney',
                'option_b' => 'Melbourne',
                'option_c' => 'Brisbane',
                'option_d' => 'Canberra',
                'correct_answer' => 'd'
            ],
            [
                'question' => '¿En qué año se fundó Microsoft?',
                'option_a' => '1975',
                'option_b' => '1976',
                'option_c' => '1985',
                'option_d' => '1980',
                'correct_answer' => 'a'
            ],
            [
                'question' => '¿Cuál es el animal terrestre más rápido?',
                'option_a' => 'León',
                'option_b' => 'Guepardo',
                'option_c' => 'Antílope',
                'option_d' => 'Leopardo',
                'correct_answer' => 'b'
            ],
            [
                'question' => '¿Quién pintó "La noche estrellada"?',
                'option_a' => 'Pablo Picasso',
                'option_b' => 'Claude Monet',
                'option_c' => 'Vincent van Gogh',
                'option_d' => 'Salvador Dalí',
                'correct_answer' => 'c'
            ],
            [
                'question' => '¿Cuál es el elemento más pesado de la tabla periódica?',
                'option_a' => 'Uranio',
                'option_b' => 'Plutonio',
                'option_c' => 'Oganesón',
                'option_d' => 'Fermio',
                'correct_answer' => 'c'
            ],
            [
                'question' => '¿En qué año se fundó la ONU?',
                'option_a' => '1943',
                'option_b' => '1944',
                'option_c' => '1945',
                'option_d' => '1946',
                'correct_answer' => 'c'
            ],
            [
                'question' => '¿Cuál es la montaña más alta del mundo?',
                'option_a' => 'K2',
                'option_b' => 'Monte Everest',
                'option_c' => 'Kangchenjunga',
                'option_d' => 'Monte McKinley',
                'correct_answer' => 'b'
            ]
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
