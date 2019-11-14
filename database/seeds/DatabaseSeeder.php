<?php

use Illuminate\Database\Seeder;

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
        $this->call(CompaniesTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        // $this->call(RolesTableSeeder::class);

        $roles = [
            ['id' => 1, 'name' => 'can_update'],
            ['id' => 2, 'name' => 'can_delete'],
            ['id' => 3, 'name' => 'can_add']
        ];

        $users = [
            [   
                'id' => 1, 
                'name' => 'SampleOne', 
                'email' => 'sampleone@gmail.com', 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => Str::random(10)
            ],
            [   
                'id' => 2, 
                'name' => 'SampleTwo',
                'email' => 'sampletwo@gmail.com', 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => Str::random(10)
            ],
            [
                'id' => 3, 
                'name' => 'SampleThree',
                'email' => 'samplethree@gmail.com', 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => Str::random(10)
            ]
        ];

        foreach($roles as $role){
            \App\Role::create($role);
        }   
        
        foreach($users as $user){
            \App\User::create($user);
        }
    }
}
