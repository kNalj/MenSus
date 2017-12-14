<?php

use Illuminate\Database\Seeder;
use App\classes;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $class = new classes();
        $class->name = "Programiranje na internetu";
        $class->semRedovni = 5;
        $class->semVanredni = 5;
        $class->classCode = "PIN";
        $class->ECTS = 6;
        $class->izborni = "da";
        $class->save();

        $class = new classes();
        $class->name = "Programiranje u JAVA-i";
        $class->semRedovni = 5;
        $class->semVanredni = 5;
        $class->classCode = "PUJ";
        $class->ECTS = 6;
        $class->izborni = "da";
        $class->save();

        $class = new classes();
        $class->name = "Strukture podataka i algoritmi";
        $class->semRedovni = 4;
        $class->semVanredni = 4;
        $class->classCode = "SPA";
        $class->ECTS = 6;
        $class->izborni = "da";
        $class->save();

        $class = new classes();
        $class->name = "Oblikovanje web stranica";
        $class->semRedovni = 6;
        $class->semVanredni = 6;
        $class->classCode = "OWS";
        $class->ECTS = 6;
        $class->izborni = "da";
        $class->save();

        $class = new classes();
        $class->name = "Analiza 2";
        $class->semRedovni = 5;
        $class->semVanredni = 5;
        $class->classCode = "AN2";
        $class->ECTS = 6;
        $class->izborni = "da";
        $class->save();
   }
}
