<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                "name"      => "admin",
                "login"     => "admin",
                "password"  => Hash::make("admin_^!#4!@$124dfASDf"),
                'role_id'      => Roles::ROLE_ADMIN,
            ],
            [
                "name"      => "Читатель",
                "login"     => "reader",
                "password"  => Hash::make("reader_At@5bs#W563425"),
                'role_id'      => Roles::ROLE_READER,
            ],
            [
                "name"      => "Редактор",
                "login"     => "redactor",
                "password"  => Hash::make("reader_gf!5ss@W553454"),
                'role_id'      => Roles::ROLE_REDACTOR,
            ],
        ];

        User::query()->insert($users);
    }
}
