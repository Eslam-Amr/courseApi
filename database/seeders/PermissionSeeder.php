<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\TechnicalEmployee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

// use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // dd(User::select('users.*', 'technical_employees.*')
        // ->join('technical_employees', 'users.id', '=', 'technical_employees.user_id')
        // ->where('technical_employees.role', 'mentor')
        // ->get());
        // dd(Role::where('name','admin')->first());
        // $category_index = Permission::firstOrCreate(['name' => 'category-index']);
        $category_update = Permission::firstOrCreate(['name' => 'category-update']);
        $category_delete = Permission::firstOrCreate(['name' => 'category-delete']);
        $category_store = Permission::firstOrCreate(['name' => 'category-store']);
        // $category_show = Permission::firstOrCreate(['name' => 'category-show']);
        // $course_index = Permission::firstOrCreate(['name' => 'course-index']);
        $course_update = Permission::firstOrCreate(['name' => 'course-update']);
        $course_delete = Permission::firstOrCreate(['name' => 'course-delete']);
        $course_store = Permission::firstOrCreate(['name' => 'course-store']);
        $region_update = Permission::firstOrCreate(['name' => 'region-update']);
        $region_delete = Permission::firstOrCreate(['name' => 'region-delete']);
        $region_store = Permission::firstOrCreate(['name' => 'region-store']);
        $technical_employee_update = Permission::firstOrCreate(['name' => 'technical-employee-update']);
        $technical_employee_delete = Permission::firstOrCreate(['name' => 'technical-employee-delete']);
        $technical_employee_store = Permission::firstOrCreate(['name' => 'technical-employee-store']);
        $employee_update = Permission::firstOrCreate(['name' => 'employee-update']);
        $employee_delete = Permission::firstOrCreate(['name' => 'employee-delete']);
        $employee_store = Permission::firstOrCreate(['name' => 'employee-store']);
        $employee_index = Permission::firstOrCreate(['name' => 'employee-index']);
        $employee_show = Permission::firstOrCreate(['name' => 'employee-show']);
        $assignment_update = Permission::firstOrCreate(['name' => 'assignment-update']);
        $assignment_delete = Permission::firstOrCreate(['name' => 'assignment-delete']);
        $assignment_store = Permission::firstOrCreate(['name' => 'assignment-store']);
        $assignment_index = Permission::firstOrCreate(['name' => 'assignment-index']);
        $assignment_show = Permission::firstOrCreate(['name' => 'assignment-show']);
        //assignment

        // $course_show = Permission::firstOrCreate(['name' => 'course-show']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo([ $category_update, $category_delete, $category_store,$course_update,$course_delete,$course_store,$region_update,$region_delete,$region_store,$technical_employee_update,$technical_employee_delete,$technical_employee_store,$employee_update,$employee_delete,$employee_store,$employee_index,$employee_show,$assignment_index,$assignment_show]);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->givePermissionTo([$assignment_update,$assignment_delete,$assignment_store,$assignment_index,$assignment_show]);
        $instractorRole = Role::firstOrCreate(['name' => 'instractor']);
        $instractorRole->givePermissionTo([$assignment_index,$assignment_show]);
        $mentorRole = Role::firstOrCreate(['name' => 'mentor']);
        $mentorRole->givePermissionTo([$assignment_index,$assignment_show]);
        /*
        user can register course and show progress and attendance
        */

        // $userRole->givePermissionTo([$category_index, $category_show]);
        $user = User::where('role', 'student')->get();
        foreach ($user as $user) {
            $user->assignRole($userRole);
        }
        /*
        $mentors = TechnicalEmployee::where('role', 'mentor')->get();
        foreach ($mentors as $mentor) {
            $mentor->assignRole($mentorRole);
        }
        $instractors = TechnicalEmployee::where('role', 'instractor')->get();
        foreach ($instractors as $instractor) {
            $instractor->assignRole($instractorRole);
        }
        */
        $mentors = User::select('users.*', 'technical_employees.*')
    ->join('technical_employees', 'users.id', '=', 'technical_employees.user_id')
    ->where('technical_employees.role', 'mentor')
    ->get();
        // $mentors = TechnicalEmployee::where('role', 'mentor')->get();
foreach ($mentors as $mentor) {
    $mentor->assignRole($mentorRole); // Specify the guard name here
}

$instructors = TechnicalEmployee::where('role', 'instructor')->get();
foreach ($instructors as $instructor) {
    $instructor->assignRole($instractorRole, 'sanctum'); // Specify the guard name here
}

        $admin = User::where('role', 'admin')->get();
        foreach ($admin as $admin) {
            $admin->assignRole($adminRole);
        }
        /*
        $employeeRole = Role::create(['name' => 'employee']);
        */
        // Permission::firstOrCreate(['name' => 'assignment-solution-delete', 'guard_name' => 'web']);
        // Permission::firstOrCreate(['name' => 'assignment-solution-delete', 'guard_name' => 'web']);

        //    Permission::create(['name'=>'assignment-solution-delete']);
        // $admin=Admin::first();
        // $admin->givePermissionTo('assignment-solution-update');
    }
}
