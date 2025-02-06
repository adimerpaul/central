<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void{

        $registerUsers = Permission::create(['name' => 'Usuarios']);
        $registerFraterno = Permission::create(['name' => 'Fraternos']);
        $registerPayments = Permission::create(['name' => 'Pagos']);

        $user = User::create([
            'name' => 'Administrador',
            'username' => 'admin',
            'avatar' => 'default.png',
            'phone' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);

        $user->givePermissionTo($registerUsers);
        $user->givePermissionTo($registerFraterno);
        $user->givePermissionTo($registerPayments);
        $sqlFile = database_path('seeders/users_202502060454.sql');
        if (file_exists($sqlFile)) {
            $sql = file_get_contents($sqlFile);
            DB::unprepared($sql);
            $this->command->info('Users table seeded');
        }else{
            $this->command->info('Users table not seeded');
        }
    }
}
