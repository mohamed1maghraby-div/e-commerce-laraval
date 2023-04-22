<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql_fiel = public_path('words_database.sql');
        $db = [
            'host' => '127.0.0.1',
            'database' => 'ecommerce',
            'username' => 'root',
            'password' => null,
        ];

        exec("mysql --user={$db['username']} --password={$db['password']} --host={$db['host']} --database={$db['database']} < $sql_fiel");
        
    }
}
