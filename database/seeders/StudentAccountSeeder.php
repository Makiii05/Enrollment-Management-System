<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\StudentAccount;

class StudentAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates student accounts for all students that don't have one yet.
     * Default password: 123
     */
    public function run(): void
    {
        $students = Student::all();
        $created = 0;
        $skipped = 0;

        foreach ($students as $student) {
            // Check if account already exists
            $existing = StudentAccount::where('student_id', $student->id)->first();
            
            if ($existing) {
                $skipped++;
                continue;
            }

            // Create new account with default password '123'
            StudentAccount::create([
                'student_id' => $student->id,
                'account_status' => 'off', // Default to off, cashier activates
                'password' => '123', // Will be hashed by the model's cast
            ]);
            
            $created++;
        }

        $this->command->info("Created {$created} student accounts. Skipped {$skipped} existing accounts.");
    }
}
