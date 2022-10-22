<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'Role-create'=>'Role',
            'Role-show'=>'Role',
            'Role-edit'=>'Role',
            'Role-delete'=>'Role',
            'Users-create'=>'Users',
            'Users-show'=>'Users',
            'Users-edit'=>'Users',
            'Users-delete'=>'Users',
        ];
        foreach ($permissions as $key=>$value) {
            Permission::create([
                'name' => $key,
                'table'=>$value
            ]);
        }
    }
}
