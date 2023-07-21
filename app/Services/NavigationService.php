<?php

namespace App\Services;

use Auth;
use Lang;

class NavigationService
{
    public static function generate_menu($active_menu)
    {
        $user = Auth::user();
        $menus = [];

        $menus[] = [
            'link' => route('dashboard'),
            'text' => "Dashboard",
            'icon' => 'bi bi-speedometer',
            'is_active' => $active_menu == 'dashboard',
            'has_submenu' => false,
            'sub_menu' => [],
        ];

        if($user->hasPermission('*-users|*-roles')) {
            $sub_menu = [];
            
            if($user->hasPermission('*-users')) {
                $sub_menu[] = [
                    'link' => route('users'),
                    'text' => "Users",
                    'is_active' => $active_menu == 'users',
                ];
            }

            if($user->hasPermission('*-roles')) {
                $sub_menu[] = [
                    'link' => route('roles'),
                    'text' => "Roles & Permissions",
                    'is_active' => $active_menu == 'roles_privilege',
                ];
            }

            $menus[] = [
                'link' => 'AdminUserDropdown',
                'text' => "Manage Users",
                'icon' => 'fas fa-user-shield',
                'is_active' => in_array($active_menu,['users', 'roles_privilege']),
                'has_submenu' => true,
                'sub_menu' => $sub_menu,
            ];
        }

        return $menus;
    }
}