<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ["name" => "Читатель"],
            ["name" => "Администратор",],
            ["name" => "Редактор",],
        ];

        Roles::query()->insert($roles);
    }
}
