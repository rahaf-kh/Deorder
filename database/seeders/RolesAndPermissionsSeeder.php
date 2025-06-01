<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Permissions;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        foreach (Permissions::all() as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $admin_role = Role::findOrCreate('admin');
        $supervisor_role = Role::findOrCreate('supervisor');
        $delivery_role = Role::findOrCreate('delivery');
        $customer_role = Role::findOrCreate('customer');

        $admin_role->givePermissionTo([
            // Permissions::Manage_Users,
            Permissions::Manage_Sopervisors,
            Permissions::Manage_Customers,
            Permissions::Manage_Deliveries,
            Permissions::Manage_Block_List,
            Permissions::Manage_Cities,
            Permissions::Manage_Areas,
            Permissions::Manage_Orders,
            Permissions::Manage_Rating,
            Permissions::Manage_Work_Time
        ]);
        $supervisor_role->givePermissionTo([
            Permissions::Manage_Customers,
            Permissions::Manage_Deliveries,
            Permissions::Manage_Block_List,
            Permissions::Manage_Orders,
            Permissions::Manage_Work_Time,
            Permissions::Manage_Delivery_Time,
            Permissions::Manage_Order_Status
        ]);
        $delivery_role->givePermissionTo([
            Permissions::Manage_Orders,
            Permissions::Manage_Delivery_Time,
            Permissions::Manage_Recive_Time,
            Permissions::Manage_Order_Status
        ]);
        $customer_role->givePermissionTo([
            Permissions::Manage_Order_Status,
            Permissions::Manage_Rating,
            Permissions::Manage_Orders,
            Permissions::Manage_Recive_Time,
        ]);

        $admin = User::firstOrCreate([
            'name' => 'Rahaf',
            'uuid' => Str::uuid()->toString(),
            'password' => Hash::make('R@7420040'),
            'email' => 'rahafkkh74@gmail.com',
            'mobile' => '0936934122',
            'address' => 'Homs',
            'bio' => 'Super Admin',
            'active' => 1,
            'expire' => now()->addYear(5),
            'type' => 'admin',
            'subscription_fees'=>'0',
            'salary'=>'0',
            'area_id'=>'1',
        ]);
        $admin->assignRole($admin_role);
    }
}
