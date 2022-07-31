<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'قائمة الصلاحيات',
            'أضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',
            'عرض صلاحية',
            'قائمة المستخدمين',
            'أضافة مستخدمين',
            'تعديل مستخدم',
            'حذف مستخدم'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
