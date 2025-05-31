<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Permissions;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        foreach (Permission::all() as $permission) {
            Permission::firstOrCreate(['naem' => $permission]);
        }
        $admin_role = Role::findOrCreate('admin');
        $supervisor_role = Role::findOrCreate('supervisor');
        $delivery_role = Role::findOrCreate('delivery');
        $customer_role = Role::findOrCreate('customer');

        $admin_role->givePermissionTo([
            Permissions::Manage_Users,
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
    }
}
