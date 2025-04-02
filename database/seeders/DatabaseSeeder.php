<?php

namespace Database\Seeders;

use App\Models\Classificators;
use App\Models\IncomingLetter;
use App\Models\OutgoingLetter;
use App\Models\User;
use App\Models\Status;
use App\Models\Role;
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

        Classificators::firstOrCreate([
            "classificator_name" => "Сторонние"
        ],
        [
            "classificator_name" => "Сторонние"
        ]);

        Classificators::firstOrCreate([
            "classificator_name" => "Сторонние"
        ],
        [
            "classificator_name" => "Сторонние"
        ]);

        Classificators::firstOrCreate([
            "classificator_name" => "УрФУ"
        ],
        [
            "classificator_name" => "УрФУ"
        ]);

        Classificators::firstOrCreate([
            "classificator_name" => "МИНОБРНАУКИ"
        ],
        [
            "classificator_name" => "МИНОБРНАУКИ"
        ]);

        Classificators::firstOrCreate([
            "classificator_name" => "НТИ(филиал)"
        ],
        [
            "classificator_name" => "НТИ(филиал)"
        ]);
        Role::firstOrCreate([
            "role_name" => "Пользователь"
        ],
        [
            "role_name" => "Пользователь"
        ]);
        Role::firstOrCreate([
            "role_name" => "Админ"
        ],
        [
            "role_name" => "Админ"
        ]);
        Role::firstOrCreate([
            "role_name" => "Гость"
        ],
        [
            "role_name" => "Гость"
        ]);
        User::firstOrCreate([
            "name" => "root",
            "email" => "root@root.ru",
        ],
        [
            "name" => "root",
            "email" => "root@root.ru",
            "password" => bcrypt("root"),
            "role_id" => 2
        ]);
        Status::firstOrCreate([
            "status_name" => "В процессе"
        ],
        [
            "status_name" => "В процессе"
        ]);
        Status::firstOrCreate([
            "status_name" => "Выполнено"
        ],
        [
            "status_name" => "Выполнено"
        ]);
        // Status::factory(5)->create();
        // Classificators::factory(5)->create();
        // IncomingLetter::factory(100)->create();
        // OutgoingLetter::factory(100)->create();
    }
}
