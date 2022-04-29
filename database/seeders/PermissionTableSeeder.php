<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           
           
             'التقارير',

            'اضافة ارض',
            'تعديل ارض',
            'حذف ارض',
            'عرض ارض',

            'اضافة مربع',
            'تعديل مربع',
            'حذف مربع',
            'عرض مربع',
            
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

       


            ];

       foreach ($permissions as $permission) {
       Permission::create(['name' => $permission]);
            }
    }//end of run
}
