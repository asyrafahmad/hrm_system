<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\LockScreen;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ExpenseReportsController;
use App\Http\Controllers\PerformanceController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// ----------------------------- main dashboard ------------------------------//
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'adminDashboard'])->name('dashboard.admin');
    Route::get('/dashboard/employee', [HomeController::class, 'employeeDashboard'])->name('dashboard.employee');
    Route::redirect('/home', '/dashboard');
    Route::redirect('home', '/dashboard');

    // ----------------------------- settings ----------------------------------------//
    Route::get('company/settings/page', [SettingController::class, 'companySettings'])->name('company.settings.page');
    Route::get('roles/permissions/page', [SettingController::class, 'rolesPermissions'])->name('roles.permissions.page');
    Route::post('roles/permissions/save', [SettingController::class, 'addRecord'])->name('roles.permissions.save');
    Route::post('roles/permissions/update', [SettingController::class, 'editRolesPermissions'])->name('roles.permissions.update');
    Route::post('roles/permissions/delete', [SettingController::class, 'deleteRolesPermissions'])->name('roles.permissions.delete');

    // ----------------------------- form employee ------------------------------//
    Route::get('all/employee/card', [EmployeeController::class, 'cardAllEmployee'])->name('all.employee.card');
    Route::get('all/employee/list', [EmployeeController::class, 'listAllEmployee'])->name('all.employee.list');
    Route::post('all/employee/save', [EmployeeController::class, 'saveRecord'])->name('all.employee.save');
    Route::get('all/employee/view/edit/{employee_id}', [EmployeeController::class, 'viewRecord']);
    Route::post('all/employee/update', [EmployeeController::class, 'updateRecord'])->name('all.employee.update');
    Route::get('all/employee/delete/{employee_id}', [EmployeeController::class, 'deleteRecord']);
    Route::post('all/employee/search', [EmployeeController::class, 'employeeSearch'])->name('all.employee.search');
    Route::post('all/employee/list/search', [EmployeeController::class, 'employeeListSearch'])->name('all.employee.list.search');

    // ----------------------------- profile employee ------------------------------//
    Route::get('employee/profile/{employee_id}', [EmployeeController::class, 'profileEmployee'])->name('profile.employee');
    Route::post('employee/update/permission', [EmployeeController::class, 'employeeUpdatePermission'])->name('employee.update.permission');

    // ----------------------------- form holiday ------------------------------//
    Route::get('form/holidays', [HolidayController::class, 'holiday'])->name('form.holidays');
    Route::get('form/holidays/new', [HolidayController::class, 'holiday'])->name('form.holidays.new');
    Route::post('form/holidays/save', [HolidayController::class, 'saveRecord'])->name('form.holidays.save');
    Route::post('form/holidays/update', [HolidayController::class, 'updateRecord'])->name('form.holidays.update');

    // ----------------------------- form leaves ------------------------------//
    Route::get('form/leaves/new', [LeavesController::class, 'leaves'])->name('form.leaves.new');
    Route::get('form/leavesemployee/new', [LeavesController::class, 'leavesEmployee'])->name('form.leaves.employee.new');
    Route::post('form/leaves/save', [LeavesController::class, 'saveRecord'])->name('form.leaves.save');
    Route::post('form/leaves/edit', [LeavesController::class, 'editRecordLeave'])->name('form.leaves.edit');
    Route::post('form/leaves/edit/delete', [LeavesController::class, 'deleteLeave'])->name('form.leaves.edit.delete');
    Route::get('form/leavesettings/page', [LeavesController::class, 'leaveSettings'])->name('form.leavesettings.page');

    // ----------------------------- form attendance  ------------------------------//
    Route::get('attendance/page', [LeavesController::class, 'attendanceIndex'])->name('attendance.page');
    Route::get('attendance/employee/page', [LeavesController::class, 'AttendanceEmployee'])->name('attendance.employee.page');
    Route::get('form/shiftscheduling/page', [LeavesController::class, 'shiftScheduLing'])->name('form.shift.scheduling.page');
    Route::get('form/shiftlist/page', [LeavesController::class, 'shiftList'])->name('form.shiftlist.page');

    // ----------------------------- user profile ------------------------------//
    Route::get('profile_user', [UserManagementController::class, 'profile'])->name('profile_user');
    Route::get('profile_user/report_to/{employee_id}', [UserManagementController::class, 'profileReportTo'])->name('profile_user.report_to');
    Route::post('profile/information/save', [UserManagementController::class, 'profileInformation'])->name('profile.information.save');
    Route::post('profile/personal_information/save', [UserManagementController::class, 'profilePersonalInformationContact'])->name('profile.personal_information.save');
    Route::post('profile/emergency_contact/save', [UserManagementController::class, 'profileEmergencyContact'])->name('profile.emergency_contact.save');
    Route::post('profile/family_information/save', [UserManagementController::class, 'profileFamilyInformationContact'])->name('profile.family_information.save');
    Route::post('profile/bank_information/save', [UserManagementController::class, 'profileBankInformation'])->name('profile.bank_information.save');
    Route::post('profile/education_information/save', [UserManagementController::class, 'profileEducationInformation'])->name('profile.education_information.save');
    Route::post('profile/experience_information/save', [UserManagementController::class, 'profileExperienceInformation'])->name('profile.experience_information.save');

    // ----------------------------- form change password ------------------------------//
    Route::get('change/password', [UserManagementController::class, 'changePasswordView'])->name('change.password');
    Route::post('change/password/db', [UserManagementController::class, 'changePasswordDB'])->name('change/password/db');

    // ----------------------------- form payroll  ------------------------------//
    Route::get('form/salary/page', [PayrollController::class, 'salary'])->name('form.salary.page');
    Route::post('form/salary/save', [PayrollController::class, 'saveRecord'])->name('form.salary.save');
    Route::post('form/salary/update', [PayrollController::class, 'updateRecord'])->name('form.salary.update');
    Route::post('form/salary/delete', [PayrollController::class, 'deleteRecord'])->name('form.salary.delete');
    Route::get('form/salary/view/{employee_id}', [PayrollController::class, 'salaryView'])->name('form.salary.view');
    Route::get('form/payroll/items', [PayrollController::class, 'payrollItems'])->middleware('auth')->name('form.payroll.items');

});

Route::middleware(['auth', 'permission:employee.update'])->group(function () {
    Route::get('employee/edit/permission/{employee_id}', [EmployeeController::class, 'employeeEditPermission'])->name('employee.edit.permission');
});

// -----------------------------login----------------------------------------//
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ----------------------------- lock screen --------------------------------//
Route::get('lock_screen', [App\Http\Controllers\LockScreen::class, 'lockScreen'])->middleware('auth')->name('lock_screen');
Route::post('unlock', [App\Http\Controllers\LockScreen::class, 'unlock'])->name('unlock');

// ------------------------------ register ---------------------------------//
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'storeUser'])->name('register');

// ----------------------------- forget password ----------------------------//
Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'getEmail'])->name('forget-password');
Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'postEmail'])->name('forget-password');

// ----------------------------- reset password -----------------------------//
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'getPassword']);
Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePassword']);


// ----------------------------- user userManagement -----------------------//
Route::get('userManagement', [App\Http\Controllers\UserManagementController::class, 'index'])->middleware('auth')->name('userManagement');
Route::post('user/add/save', [App\Http\Controllers\UserManagementController::class, 'addNewUserSave'])->name('user/add/save');
Route::post('search/user/list', [App\Http\Controllers\UserManagementController::class, 'searchUser'])->name('search/user/list');
Route::post('update', [App\Http\Controllers\UserManagementController::class, 'update'])->name('update');
Route::post('user/delete', [App\Http\Controllers\UserManagementController::class, 'delete'])->middleware('auth')->name('user/delete');
Route::get('activity/log', [App\Http\Controllers\UserManagementController::class, 'activityLog'])->middleware('auth')->name('activity/log');
Route::get('activity/login/logout', [App\Http\Controllers\UserManagementController::class, 'activityLogInLogOut'])->middleware('auth')->name('activity/login/logout');

// ----------------------------- search user management ------------------------------//
Route::post('search/user/list', [App\Http\Controllers\UserManagementController::class, 'searchUser'])->name('search/user/list');


// ----------------------------- job ------------------------------//
Route::get('form/job/list', [App\Http\Controllers\JobController::class, 'jobList'])->name('form/job/list');
Route::get('form/job/view', [App\Http\Controllers\JobController::class, 'jobView'])->name('form/job/view');






// ----------------------------- reports  ------------------------------//
Route::get('form/expense/reports/page', [App\Http\Controllers\ExpenseReportsController::class, 'index'])->middleware('auth')->name('form/expense/reports/page');
Route::get('form/invoice/reports/page', [App\Http\Controllers\ExpenseReportsController::class, 'invoiceReports'])->middleware('auth')->name('form/invoice/reports/page');
Route::get('form/invoice/view/page', [App\Http\Controllers\ExpenseReportsController::class, 'invoiceView'])->middleware('auth')->name('form/invoice/view/page');
Route::get('form/daily/reports/page', [App\Http\Controllers\ExpenseReportsController::class, 'dailyReport'])->middleware('auth')->name('form/daily/reports/page');
Route::get('form/leave/reports/page', [App\Http\Controllers\ExpenseReportsController::class, 'leaveReport'])->middleware('auth')->name('form/leave/reports/page');

// ----------------------------- performance  ------------------------------//
Route::get('form/performance/indicator/page', [App\Http\Controllers\PerformanceController::class, 'index'])->middleware('auth')->name('form/performance/indicator/page');
Route::get('form/performance/page', [App\Http\Controllers\PerformanceController::class, 'performance'])->middleware('auth')->name('form/performance/page');
Route::get('form/performance/appraisal/page', [App\Http\Controllers\PerformanceController::class, 'performanceAppraisal'])->middleware('auth')->name('form/performance/appraisal/page');
Route::post('form/performance/indicator/save', [App\Http\Controllers\PerformanceController::class, 'saveRecordIndicator'])->middleware('auth')->name('form/performance/indicator/save');
Route::post('form/performance/indicator/delete', [App\Http\Controllers\PerformanceController::class, 'deleteIndicator'])->middleware('auth')->name('form/performance/indicator/delete');
Route::post('form/performance/indicator/update', [App\Http\Controllers\PerformanceController::class, 'updateIndicator'])->middleware('auth')->name('form/performance/indicator/update');

Route::post('form/performance/appraisal/save', [App\Http\Controllers\PerformanceController::class, 'saveRecordAppraisal'])->middleware('auth')->name('form/performance/appraisal/save');
Route::post('form/performance/appraisal/update', [App\Http\Controllers\PerformanceController::class, 'updateAppraisal'])->middleware('auth')->name('form/performance/appraisal/update');
Route::post('form/performance/appraisal/delete', [App\Http\Controllers\PerformanceController::class, 'deleteAppraisal'])->middleware('auth')->name('form/performance/appraisal/delete');

// ----------------------------- training  ------------------------------//
Route::get('form/training/list/page', [App\Http\Controllers\TrainingController::class, 'index'])->middleware('auth')->name('form/training/list/page');
Route::post('form/training/save', [App\Http\Controllers\TrainingController::class, 'addNewTraining'])->middleware('auth')->name('form/training/save');
Route::post('form/training/delete', [App\Http\Controllers\TrainingController::class, 'deleteTraining'])->middleware('auth')->name('form/training/delete');
Route::post('form/training/update', [App\Http\Controllers\TrainingController::class, 'updateTraining'])->middleware('auth')->name('form/training/update');

// ----------------------------- trainers  ------------------------------//
Route::get('form/trainers/list/page', [App\Http\Controllers\TrainersController::class, 'index'])->middleware('auth')->name('form/trainers/list/page');
Route::post('form/trainers/save', [App\Http\Controllers\TrainersController::class, 'saveRecord'])->middleware('auth')->name('form/trainers/save');
Route::post('form/trainers/update', [App\Http\Controllers\TrainersController::class, 'updateRecord'])->middleware('auth')->name('form/trainers/update');
Route::post('form/trainers/delete', [App\Http\Controllers\TrainersController::class, 'deleteRecord'])->middleware('auth')->name('form/trainers/delete');

// ----------------------------- training type  ------------------------------//
Route::get('form/training/type/list/page', [App\Http\Controllers\TrainingTypeController::class, 'index'])->middleware('auth')->name('form/training/type/list/page');
Route::post('form/training/type/save', [App\Http\Controllers\TrainingTypeController::class, 'saveRecord'])->middleware('auth')->name('form/training/type/save');
Route::post('form//training/type/update', [App\Http\Controllers\TrainingTypeController::class, 'updateRecord'])->middleware('auth')->name('form//training/type/update');
Route::post('form//training/type/delete', [App\Http\Controllers\TrainingTypeController::class, 'deleteTrainingType'])->middleware('auth')->name('form//training/type/delete');

