<?php

namespace Database\Seeders;

use App\Models\Classificators;
use App\Models\IncomingLetter;
use App\Models\OutgoingLetter;
use App\Models\User;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table( 'classificators')->insert([
            'classificator_name' => "Сторонние"
        ]);

        DB::table( 'classificators')->insert([
            'classificator_name' => "УрФУ"
        ]);

        DB::table( 'classificators')->insert([
            'classificator_name' => "МИНОБРНАУКИ"
        ]);

        DB::table( 'classificators')->insert([
            'classificator_name' => 'НТИ(филиал)'
        ]);
        Status::factory(5)->create();
        // Classificators::factory(5)->create();
        IncomingLetter::factory(100)->create();
        OutgoingLetter::factory(100)->create();
    }
}
