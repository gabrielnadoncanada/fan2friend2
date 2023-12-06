<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
class ShieldSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"Admin","guard_name":"web","permissions":["view_category","view_any_category","create_category","update_category","restore_category","restore_any_category","replicate_category","reorder_category","delete_category","delete_any_category","force_delete_category","force_delete_any_category","view_celebrity","view_any_celebrity","create_celebrity","update_celebrity","restore_celebrity","restore_any_celebrity","replicate_celebrity","reorder_celebrity","delete_celebrity","delete_any_celebrity","force_delete_celebrity","force_delete_any_celebrity","view_order","view_any_order","create_order","update_order","restore_order","restore_any_order","replicate_order","reorder_order","delete_order","delete_any_order","force_delete_order","force_delete_any_order","view_order::item","view_any_order::item","create_order::item","update_order::item","restore_order::item","restore_any_order::item","replicate_order::item","reorder_order::item","delete_order::item","delete_any_order::item","force_delete_order::item","force_delete_any_order::item","view_partner","view_any_partner","create_partner","update_partner","restore_partner","restore_any_partner","replicate_partner","reorder_partner","delete_partner","delete_any_partner","force_delete_partner","force_delete_any_partner","view_payment","view_any_payment","create_payment","update_payment","restore_payment","restore_any_payment","replicate_payment","reorder_payment","delete_payment","delete_any_payment","force_delete_payment","force_delete_any_payment","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_any_user","view_own_user","create_user","update_any_user","update_own_user","delete_any_user","delete_own_user"]},{"name":"Customer","guard_name":"web","permissions":["view_category","view_any_category","create_category","update_category","restore_category","restore_any_category","replicate_category","reorder_category","delete_category","delete_any_category","force_delete_category","force_delete_any_category","view_celebrity","view_any_celebrity","create_celebrity","update_celebrity","restore_celebrity","restore_any_celebrity","replicate_celebrity","reorder_celebrity","delete_celebrity","delete_any_celebrity","force_delete_celebrity","force_delete_any_celebrity","view_order","view_any_order","create_order","update_order","restore_order","restore_any_order","replicate_order","reorder_order","delete_order","delete_any_order","force_delete_order","force_delete_any_order","view_order::item","view_any_order::item","create_order::item","update_order::item","restore_order::item","restore_any_order::item","replicate_order::item","reorder_order::item","delete_order::item","delete_any_order::item","force_delete_order::item","force_delete_any_order::item","view_partner","view_any_partner","create_partner","update_partner","restore_partner","restore_any_partner","replicate_partner","reorder_partner","delete_partner","delete_any_partner","force_delete_partner","force_delete_any_partner","view_payment","view_any_payment","create_payment","update_payment","restore_payment","restore_any_payment","replicate_payment","reorder_payment","delete_payment","delete_any_payment","force_delete_payment","force_delete_any_payment","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_any_user","view_own_user","create_user","update_any_user","update_own_user","delete_any_user","delete_own_user"]},{"name":"Celebrity","guard_name":"web","permissions":["view_category","view_any_category","create_category","update_category","restore_category","restore_any_category","replicate_category","reorder_category","delete_category","delete_any_category","force_delete_category","force_delete_any_category","view_celebrity","view_any_celebrity","create_celebrity","update_celebrity","restore_celebrity","restore_any_celebrity","replicate_celebrity","reorder_celebrity","delete_celebrity","delete_any_celebrity","force_delete_celebrity","force_delete_any_celebrity","view_order","view_any_order","create_order","update_order","restore_order","restore_any_order","replicate_order","reorder_order","delete_order","delete_any_order","force_delete_order","force_delete_any_order","view_order::item","view_any_order::item","create_order::item","update_order::item","restore_order::item","restore_any_order::item","replicate_order::item","reorder_order::item","delete_order::item","delete_any_order::item","force_delete_order::item","force_delete_any_order::item","view_partner","view_any_partner","create_partner","update_partner","restore_partner","restore_any_partner","replicate_partner","reorder_partner","delete_partner","delete_any_partner","force_delete_partner","force_delete_any_partner","view_payment","view_any_payment","create_payment","update_payment","restore_payment","restore_any_payment","replicate_payment","reorder_payment","delete_payment","delete_any_payment","force_delete_payment","force_delete_any_payment","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_any_user","view_own_user","create_user","update_any_user","update_own_user","delete_any_user","delete_own_user"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions,true))) {

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = Utils::getRoleModel()::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name']
                ]);

                if (! blank($rolePlusPermission['permissions'])) {

                    $permissionModels = collect();

                    collect($rolePlusPermission['permissions'])
                        ->each(function ($permission) use($permissionModels) {
                            $permissionModels->push(Utils::getPermissionModel()::firstOrCreate([
                                'name' => $permission,
                                'guard_name' => 'web'
                            ]));
                        });
                    $role->syncPermissions($permissionModels);

                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions,true))) {

            foreach($permissions as $permission) {

                if (Utils::getPermissionModel()::whereName($permission)->doesntExist()) {
                    Utils::getPermissionModel()::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
