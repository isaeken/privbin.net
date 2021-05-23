<?php

namespace Database\Seeders;

use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            return tap(User::create([
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@local',
                'password' => Hash::make('password'),
            ]), function (User $user) {
                (new CreateNewUser)->createPersonalTeam($user);
            });
        });

         // \App\Models\User::factory(10)->create();
    }
}
