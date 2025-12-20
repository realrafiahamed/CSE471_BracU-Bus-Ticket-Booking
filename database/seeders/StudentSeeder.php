<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::updateOrCreate(
            ['student_id' => '2223456'], // check only student_id
            [
                'name' => 'Sadia Rahman',
                'email' => 'sadia@g.ac.com',
                'department' => 'CSE',
                'status' => 'active',
            ]
        );

        Student::updateOrCreate(
            ['student_id' => '2233454'],
            [
                'name' => 'Tanvir Hossain',
                'email' => 'tanvir@g.ac.com',
                'department' => 'CSE',
                'status' => 'active',
            ]
        );

        Student::updateOrCreate(
            ['student_id' => '2263450'],
            [
                'name' => 'Shamim Ahmed',
                'email' => 'shamim@g.ac.com',
                'department' => 'CSE',
                'status' => 'active',
            ]
        );

        Student::updateOrCreate(
            ['student_id' => '2245610'],
            [
                'name' => 'Zaira Ahmed',
                'email' => 'zaira@g.ac.com', // duplicate email is ok now
                'department' => 'BBA',
                'status' => 'active',
            ]
        );

        Student::updateOrCreate(
            ['student_id' => '2210110'],
            [
                'name' => 'Rafa Hosain',
                'email' => 'rafa@g.ac.com',
                'department' => 'EEE',
                'status' => 'active',
            ]
        );

        Student::updateOrCreate(
            ['student_id' => '2223356'],
            [
                'name' => 'Niloy Hossain',
                'email' => 'niloy@g.ac.com',
                'department' => 'EEE',
                'status' => 'non active',
            ]
        );

        Student::updateOrCreate(
            ['student_id' => '2229547'],
            [
                'name' => 'Shakil Ahmed',
                'email' => 'shkil@g.ac.com',
                'department' => 'BBA',
                'status' => 'active',
            ]
        );

        Student::updateOrCreate(
            ['student_id' => '2221014'],
            [
                'name' => 'Anisha Akther',
                'email' => 'anisha@g.ac.com',
                'department' => 'CSE',
                'status' => 'active',
            ]
        );
    }
}
