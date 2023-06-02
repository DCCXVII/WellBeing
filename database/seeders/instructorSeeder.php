<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class instructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $instructorRole = Role::findByName('instructor');

        User::create([
            'name' => 'John 1',
            'email' => 'Doe@example.com',
            'password' => Hash::make('password123'),
            'abonne' => 1,
            'img_url' => 'https://d2lesx9toesny3.cloudfront.net/normal_334efd36-2eb0-4c0b-ad68-76dff09cb0fd.jpg',
            'description' => 'Lorem ipsum dolor sit amet.',
            'instagram_url' => 'https://www.instagram.com/john',
            'created_at' => '2023-05-22 10:00:00',
            'updated_at' => '2023-05-22 12:00:00',
            
            'background_img' => 'https://dplvxv40qur9n.cloudfront.net/0fa76adf-b3de-4d62-9aca-ad8fee622042.jpg',
            ])->assignRole($instructorRole);
            
            User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password456'),
            'abonne' => 0,
            'img_url' => 'https://d2lesx9toesny3.cloudfront.net/normal_658ac6dc-b94a-43e1-912c-a04805c6e738.jpg',
            'description' => 'Lorem ipsum dolor sit amet.',
            'instagram_url' => 'https://www.instagram.com/jane',
            'created_at' => '2023-05-23 10:00:00',
            'updated_at' => '2023-05-23 12:00:00',
                        'background_img' => 'https://dplvxv40qur9n.cloudfront.net/a04852c9-ba7a-4b55-8a0d-462c54c43aa1.jpg',
            ])->assignRole($instructorRole);
            
            User::create([
            'name' => 'Mark Johnson',
            'email' => 'mark@example.com',
            'password' => Hash::make('password789'),
            'abonne' => 1,
            'img_url' => 'https://d2lesx9toesny3.cloudfront.net/normal_b8f36466-712c-411a-a34f-22f54cba5c02.jpg',
            'description' => 'Lorem ipsum dolor sit amet.',
            'instagram_url' => 'https://www.instagram.com/mark',
            'created_at' => '2023-05-24 10:00:00',
            'updated_at' => '2023-05-24 12:00:00',
            
            'background_img' => 'https://dplvxv40qur9n.cloudfront.net/ec7fd3eb-0c35-4c19-9f0e-2aa94b0c58c8.jpg',
            ])->assignRole($instructorRole);

            User::create([
                'name' => 'Houss 86',
                'email' => 'Houss86@example.com',
                'password' => Hash::make('Houss1986'),
                'abonne' => 1,
                'img_url' => 'https://d2lesx9toesny3.cloudfront.net/normal_99799f7a-cfa7-4352-9033-58897f7ebe54.jpg',
                'description' => 'Lorem ipsum dolor sit amet.',
                'instagram_url' => 'https://www.instagram.com/mark',
                'created_at' => '2023-05-24 10:00:00',
                'updated_at' => '2023-05-24 12:00:00',
                
                'background_img' => 'https://dplvxv40qur9n.cloudfront.net/823bf0a9-0b4e-47f0-8d80-67a7db8c9cb1.jpg',
                ])->assignRole($instructorRole);
    }
}
 