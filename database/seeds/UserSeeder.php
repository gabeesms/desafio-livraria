<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = [
            [
                'name' => 'Administrador Teste',
                'email' => 'admin@email.com',
                'password' => '12345678',
                'admin' => true
            ],
            [
                'name' => 'Moderador Teste',
                'email' => 'moderador@email.com',
                'password' => '12345678',
                'admin' => false
            ]
        ];

        foreach($usuarios as $u) {
            User::firstOrCreate(
                [
                    'email' => $u['email']
                ],
                [
                    'name' => $u['name'],
                    'email' => $u['email'],
                    'password' => $u['password'],
                    'admin' => $u['admin']
                ]
            );
        }
    }
}
