<?php

namespace App;

class Permissions
{
    const Manage_Users = 'manage users';
    const Manage_Sopervisors = 'manage supervisors';
    const Manage_Deliveries = 'manage deliveries';
    const Manage_Customers = 'manage customers';
    const Manage_Areas = 'manage areas';
    const Manage_Cities = 'manage citeis';
    const Manage_Orders = 'manage orders';
    const Manage_Rating = 'manage rating';
    const Manage_Block_List = 'block list';
    const Manage_Work_Time = 'manage work time';
    const Manage_Delivery_Time = 'manage delivery time';
    const Manage_Recive_Time = 'manage recive time';
    const Manage_Order_Status = 'manage order status';


    public static function all(): array
    {
        return [
            self::Manage_Users,
            self::Manage_Sopervisors,
            self::Manage_Deliveries,
            self::Manage_Customers,
            self::Manage_Areas,
            self::Manage_Cities,
            self::Manage_Orders,
            self::Manage_Rating,
            self::Manage_Block_List,
            self::Manage_Work_Time,
            self::Manage_Delivery_Time,
            self::Manage_Recive_Time,
            self::Manage_Order_Status
        ];
    }
}
