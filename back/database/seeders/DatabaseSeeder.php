<?php

namespace Database\Seeders;

use App\Models\Concepto;
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


        Concepto::create(['nombre' => 'Cuota Misal', 'descripcion' => 'Cuota de misal', 'tipo' => 'Cobro', 'monto' => 100, 'estado' => 'Activo']);
        Concepto::create(['nombre' => 'Cuota Velada', 'descripcion' => 'Cuota de velada', 'tipo' => 'Cobro', 'monto' => 50, 'estado' => 'Activo']);
        Concepto::create(['nombre' => 'Aporte Extraordinario', 'descripcion' => 'Aporte extraordinario', 'tipo' => 'Cobro', 'monto' => 200, 'estado' => 'Activo']);
        Concepto::create(['nombre' => 'Llamada de Atención', 'descripcion' => 'Llamada de atención', 'tipo' => 'Llamada', 'monto' => 20, 'estado' => 'Activo']);
        Concepto::create(['nombre' => 'Expulsión de Recorrido', 'descripcion' => 'Expulsión de recorrido', 'tipo' => 'Llamada', 'monto' => 100, 'estado' => 'Activo']);
        Concepto::create(['nombre' => 'Invitación a Ensayo Danza', 'descripcion' => 'Invitación a ensayo danza', 'tipo' => 'Llamada', 'monto' => 20, 'estado' => 'Activo']);


    }
}
