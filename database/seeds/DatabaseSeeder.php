<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InstitutionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(UserTableSeeder::class);
//        $this->call(GenresTableSeeder::class);
//        $this->call(MoviesTableSeeder::class);
        $this->call(ISEED_GenresTableSeeder::class);
        $this->call(ISEED_MoviesTableSeeder::class);
        $this->call(ISEED_MoviesGenresTableSeeder::class);
    }
}
