<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        \DB::table('users')->insert(
            array(
                0 =>
                    array(
                        'id' => 1,
                        'name' => 'Administrador',
                        'email' => 'admin@admin.com',
                        'email_verified_at' => NULL,
                        'password' => bcrypt('admin'),
                        'remember_token' => NULL,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    )
            ));
    }
}
