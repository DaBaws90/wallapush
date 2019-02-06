<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class)->create(['name'=> 'Admin','email' => 'admin@admin.com', 'role' => 'admin']);
        factory(\App\User::class, 75)->create();
        factory(\App\categoria::class, 20)->create();
        factory(\App\anuncio::class, 50)->create();
        factory(\App\image::class, 125)->create();
    }
}
