<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roleAdmin = Role::create(['name'=>'admin']);
        $roleUser = Role::create(['name'=>'user']);

        //$roleAdmin->syncPermissionTo(Permission::create([]))

        \App\Models\Producto::factory(30)->create();


        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$Vvjco55nc4zHvdvFLyWCReXSo31BhJ0XtviPlj4Y5hpN282HVjIVq',
        ])->assignRole('admin');
        \App\Models\User::factory()->create([
            'name' => 'Evelin Mariana Gonzalez Alvarado',
            'email' => 'evelin.gonzalez7399@alumnos.udg.mx',
            'password' => '$2y$10$Vvjco55nc4zHvdvFLyWCReXSo31BhJ0XtviPlj4Y5hpN282HVjIVq',
        ])->assignRole('user');



    }
}
