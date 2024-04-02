<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\TechnicalEmployee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        /*
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
        ]);
        */
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
        $assignment_solution_update = Permission::firstOrCreate(['name' => 'assignment-solution-update']);
        $assignment_solution_delete = Permission::firstOrCreate(['name' => 'assignment-solution-delete']);
        $assignment_solution_store = Permission::firstOrCreate(['name' => 'assignment-solution-store']);
        $assignment_solution_index = Permission::firstOrCreate(['name' => 'assignment-solution-index']);
        $assignment_solution_show = Permission::firstOrCreate(['name' => 'assignment-solution-show']);
        $course_registeration_update = Permission::firstOrCreate(['name' => 'course-registeration-update']);
        $course_registeration_delete = Permission::firstOrCreate(['name' => 'course-registeration-delete']);
        $course_registeration_store = Permission::firstOrCreate(['name' => 'course-registeration-store']);
        $course_registeration_index = Permission::firstOrCreate(['name' => 'course-registeration-index']);
        $course_registeration_show = Permission::firstOrCreate(['name' => 'course-registeration-show']);
        $attendance_update = Permission::firstOrCreate(['name' => 'attendance-update']);
        $attendance_delete = Permission::firstOrCreate(['name' => 'attendance-delete']);
        $attendance_store = Permission::firstOrCreate(['name' => 'attendance-store']);
        $attendance_index = Permission::firstOrCreate(['name' => 'attendance-index']);
        $attendance_show = Permission::firstOrCreate(['name' => 'attendance-show']);
        $group_technical_employee_update = Permission::firstOrCreate(['name' => 'group-technical-employee-update']);
        $group_technical_employee_delete = Permission::firstOrCreate(['name' => 'group-technical-employee-delete']);
        $group_technical_employee_store = Permission::firstOrCreate(['name' => 'group-technical-employee-store']);
        $group_technical_employee_index = Permission::firstOrCreate(['name' => 'group-technical-employee-index']);
        $group_technical_employee_show = Permission::firstOrCreate(['name' => 'group-technical-employee-show']);
        $group_update = Permission::firstOrCreate(['name' => 'group-update']);
        $group_delete = Permission::firstOrCreate(['name' => 'group-delete']);
        $group_store = Permission::firstOrCreate(['name' => 'group-store']);
        $group_index = Permission::firstOrCreate(['name' => 'group-index']);
        $group_show = Permission::firstOrCreate(['name' => 'group-show']);
        $session_update = Permission::firstOrCreate(['name' => 'session-update']);
        $session_delete = Permission::firstOrCreate(['name' => 'session-delete']);
        $session_store = Permission::firstOrCreate(['name' => 'session-store']);
        $session_index = Permission::firstOrCreate(['name' => 'session-index']);
        $session_show = Permission::firstOrCreate(['name' => 'session-show']);
        // $user_register = Permission::firstOrCreate(['name' => 'user-createAccount']);
        //assignment

        // $course_show = Permission::firstOrCreate(['name' => 'course-show']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo([ $category_update, $category_delete, $category_store,$course_update,$course_delete,$course_store,$region_update,$region_delete,$region_store,$technical_employee_update,$technical_employee_delete,$technical_employee_store,$employee_update,$employee_delete,$employee_store,$employee_index,$employee_show,$assignment_index,$assignment_show,$attendance_update,$attendance_delete,$attendance_store,$attendance_index,$attendance_show,$group_technical_employee_update,$group_technical_employee_delete,$group_technical_employee_store,$group_technical_employee_index,$group_technical_employee_show,$group_update,$group_delete,$group_store,$group_index,$group_show,$session_update,$session_delete,$session_store,$session_index,$session_show]);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->givePermissionTo([$assignment_solution_index,$assignment_solution_show,$assignment_index,$assignment_show,$course_registeration_update,$course_registeration_delete,$course_registeration_store,$course_registeration_index,$course_registeration_show,$assignment_solution_store,$assignment_solution_index,$assignment_solution_show,$attendance_index,$attendance_show,$group_index,$group_show,$session_index,$session_show]);
        $instractorRole = Role::firstOrCreate(['name' => 'instractor']);
        $instractorRole->givePermissionTo([$assignment_solution_index,$assignment_solution_show,$assignment_update,$assignment_delete,$assignment_store,$assignment_index,$assignment_show,$attendance_update,$attendance_delete,$attendance_store,$attendance_index,$attendance_show,$group_index,$group_show,$session_index,$session_show]);
        $mentorRole = Role::firstOrCreate(['name' => 'mentor']);
        $mentorRole->givePermissionTo([$assignment_update,$assignment_delete,$assignment_store,$assignment_index,$assignment_show,$assignment_solution_update,$assignment_solution_delete,$assignment_solution_index,$assignment_solution_show,$attendance_update,$attendance_delete,$attendance_store,$attendance_index,$attendance_show,$group_index,$group_show,$session_index,$session_show]);
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
