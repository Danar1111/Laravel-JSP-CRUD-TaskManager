<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'name'=>'Danar',
                'email'=>'danar@gmail.com',
                'password'=>bcrypt('danar')
            ],
            [
                'name'=>'Sodik',
                'email'=>'sodik@gmail.com',
                'password'=>bcrypt('sodik')
            ],
        ];

        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}