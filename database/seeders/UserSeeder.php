<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::updateOrCreate(
            ['email' => 'admin@realestate.local'],
            [
                'name' => 'المدير العام (Super Admin)',
                'password' => Hash::make('password'),
                'phone' => '+201000000001',
                'bio' => 'مدير النظام الأساسي للمنصة العقارية',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole('super-admin');

        $agent = User::updateOrCreate(
            ['email' => 'agent@realestate.local'],
            [
                'name' => 'أحمد الشناوي (وكيل عقاري)',
                'password' => Hash::make('password'),
                'phone' => '+201000000002',
                'bio' => 'مستشار عقاري متخصص في مبيعات التجمع الخامس والشيخ زايد',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $agent->assignRole('agent');

        $client = User::updateOrCreate(
            ['email' => 'client@realestate.local'],
            [
                'name' => 'محمود عبد الرحمن (عميل)',
                'password' => Hash::make('password'),
                'phone' => '+201000000003',
                'bio' => 'مستثمر ومهتم بالوحدات التجارية والسكنية',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $client->assignRole('client');
    }
}
