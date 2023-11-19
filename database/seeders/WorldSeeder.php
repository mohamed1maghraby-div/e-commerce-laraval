<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql_fiel = file('/var/www/public/words_database.sql');
        $sql = implode('', $sql_fiel);
        DB::unprepared($sql);

        /* $db = [
            'host' => config('DB_HOST'),
            'database' => config('DB_DATABASE'),
            'username' => config('DB_USERNAME'),
            'password' => config('DB_PASSWORD'),
        ];

        exec("mysql --user={$db['username']} --password={$db['password']} --host={$db['host']} --database={$db['database']} < $sql_fiel"); */
        
    }
}
