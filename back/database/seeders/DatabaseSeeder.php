<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        $registerUsers = Permission::create(['name' => 'Registro de usuarios']);
        $registerFraterno = Permission::create(['name' => 'Registro de fraterno']);
        $registerPayments = Permission::create(['name' => 'Registro de pagos']);

        $user = User::create([
            'name' => 'Administrador',
            'nickname' => 'admin',
            'avatar' => 'default.png',
            'phone' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);

        $user->givePermissionTo($registerUsers);
        $user->givePermissionTo($registerFraterno);
        $user->givePermissionTo($registerPayments);

        User::factory(10)->create();
    }
}
