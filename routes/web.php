<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthDashboardController;
use App\Http\Controllers\StaffAuthDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataStaffController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SalaryCutController;
use App\Http\Controllers\SalaryAllowanceController;
use App\Http\Controllers\CutAllowanceTypeController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\MasterLeaveTypeController;
use App\Http\Controllers\MasterJobScheduleController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\MasterAchievementController;
use App\Http\Controllers\TransactionPaidLeaveController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\TransactionTicketingController;
use App\Http\Controllers\MasterJobController;
use App\Http\Controllers\MasterRecruitmentController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\WorkFromHomeController;
use App\Http\Controllers\OvertimeController;
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


//route Auth
Route::get('/', 'Auth\AuthController@redirect')->name('login');
Route::get('/login', 'Auth\AuthController@login')->name('login');
Route::post('/login', 'Auth\AuthController@authenticate');
Route::get('/logout', 'Auth\AuthController@logout')->name('logout');

Route::get('/admin/dashboard', [AdminAuthDashboardController::class,'index'])->middleware('auth');
Route::get('/staff/dashboard', [StaffAuthDashboardController::class,'index'])->middleware('auth');
Route::get('/staff/charts/ajax', [StaffAuthDashboardController::class,'ajx'])->name('ajx');
Route::get('/staff/password',[UserController::class,'edit'])->middleware('auth');
Route::put('/staff/password/saved',[UserController::class,'update'])->middleware('auth');
Route::get('/admin/password',[UserController::class,'edit'])->middleware('auth');
Route::put('/admin/password/saved',[UserController::class,'update'])->middleware('auth');

//route profile
Route::get('/admin/profile', [AdminAuthDashboardController::class,'profile']);
Route::get('/admin/profile/edit', [AdminAuthDashboardController::class,'editprofile']);
Route::put('/admin/profile/{user}', [AdminAuthDashboardController::class,'updateprofile']);
Route::get('/staff/profile', [StaffAuthDashboardController::class,'profile']);
Route::get('/staff/profile/edit', [StaffAuthDashboardController::class,'editprofile']);
Route::put('/staff/profile/{user}', [StaffAuthDashboardController::class,'updateprofile']);

//route landing dashboard, ganti password & profil ==ADMIN==
Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminAuthDashboardController::class,'index']);
    Route::get('/password/{user}',[UserController::class,'edit']);
    Route::put('/password/{user}/saved',[UserController::class,'update']);
    Route::get('/profile', [AdminAuthDashboardController::class,'profile']);
    Route::get('/profile/edit', [AdminAuthDashboardController::class,'editprofile']);
    Route::put('/profile/{user}', [AdminAuthDashboardController::class,'updateprofile']);
    Route::post('/foto', [UserController::class,'change_photo_profile']);
});

//route landing dashboard, ganti password & profil ==STAFF==
Route::prefix('/staff')->group(function(){
    Route::get('/dashboard', [StaffAuthDashboardController::class,'index']);
    Route::get('/password/{user}',[UserController::class,'edit']);
    Route::put('/password/{user}/saved',[UserController::class,'update']);
    Route::get('/profile', [StaffAuthDashboardController::class,'profile']);
    Route::get('/profile/edit', [StaffAuthDashboardController::class,'editprofile']);
    Route::put('/profile/{user}', [StaffAuthDashboardController::class,'updateprofile']);
    Route::post('/foto', [UserController::class,'change_photo_profile']);
});

//route masterdata staff
Route::prefix('/admin/data-staff')->group(function(){
    Route::get('/',[DataStaffController::class,'index']);
    Route::get('/add',[DataStaffController::class,'create']);
    Route::post('/', [DataStaffController::class, 'store']);
    Route::get('/{staff}/edit', [DataStaffController::class, 'edit']);
    Route::put('/{staff}', [DataStaffController::class, 'update']);
    Route::put('/{staff}/password', [DataStaffController::class, 'reset_pass']);
    Route::put('/{staff}/status', [DataStaffController::class, 'toogle_status']);
    Route::delete('/', [DataStaffController::class, 'destroySelected']);
    Route::get('/search', [DataStaffController::class, 'search']);
});
//route agenda kerja ==ADMIN==
Route::prefix('/admin/agenda')->group(function(){
    Route::get('/',[AgendaController::class,'index']);
    Route::get('/add',[AgendaController::class,'create']);
    Route::post('/', [AgendaController::class, 'store']);
    Route::get('/{agenda}/edit', [AgendaController::class, 'edit']);
    Route::put('/{agenda}', [AgendaController::class, 'update']);
    Route::delete('/', [AgendaController::class, 'destroy']);
    Route::get('/search',[AgendaController::class, 'search']);
    Route::get('/calendar',[AgendaController::class,'searchCalendar']);
    Route::post('/calendar',[AgendaController::class,'calendar']);
});

//route agenda kerja ==STAFF==
Route::prefix('/staff/agenda')->group(function(){
    Route::get('/',[AgendaController::class,'index_staff']);
});
//route promotion staff 
Route::prefix('/admin/data-staff/promote')->group(function(){
    Route::get('/{staff}',[DataStaffController::class,'promotion']);
    Route::post('/calculate',[DataStaffController::class,'promotion_calculate']);
    Route::post('/approved', [DataStaffController::class, 'promotion_approved']);

});
//route masterdata divisi
Route::prefix('/admin/division')->group(function(){
    Route::get('/',[DivisionController::class,'index']);
    Route::get('/add',[DivisionController::class,'create']);
    Route::post('/', [DivisionController::class, 'store']);
    Route::get('/{division}/edit', [DivisionController::class, 'edit']);
    Route::put('/{division}', [DivisionController::class, 'update']);
    Route::put('/{division}/status', [DivisionController::class, 'toogle_status']);
    Route::delete('/', [DivisionController::class, 'destroySelected']);
});

//route masterdata posisi
Route::prefix('/admin/position')->group(function(){
    Route::get('/',[PositionController::class,'index']);
    Route::get('/add',[PositionController::class,'create']);
    Route::post('/', [PositionController::class, 'store']);
    Route::get('/{position}/edit', [PositionController::class, 'edit']);
    Route::put('/{position}', [PositionController::class, 'update']);
    Route::put('/{division}/status', [PositionController::class, 'toogle_status']);
    Route::delete('/', [PositionController::class, 'destroySelected']);
});

//route masterdata shift
Route::prefix('/admin/shift')->group(function(){
    Route::get('/',[ShiftController::class,'index']);
    Route::get('/add',[ShiftController::class,'create']);
    Route::post('/', [ShiftController::class, 'store']);
    Route::get('/{shift}/edit', [ShiftController::class, 'edit']);
    Route::put('/{shift}', [ShiftController::class, 'update']);
    Route::put('/{shift}/status', [ShiftController::class, 'toogle_status']);
    Route::delete('/', [ShiftController::class, 'destroySelected']);
});

//route masterdata tipe cuti
Route::prefix('/admin/paid-leave-type')->group(function (){
    Route::get('/',[MasterLeaveTypeController::class,'index'])->name('tablelist');
    Route::get('/add',[MasterLeaveTypeController::class,'create'])->name('addleavetype');
    Route::post('/',[MasterLeaveTypeController::class,'store'])->name('save');
    Route::get('/{leavetype}/edit',[MasterLeaveTypeController::class,'edit']);
    Route::put('/{leavetype}',[MasterLeaveTypeController::class,'update'])->name('update');
    Route::put('/{leavetype}/status', [MasterLeaveTypeController::class, 'toogle_status']);
    Route::delete('/',[MasterLeaveTypeController::class,'destroyAll']); 
});

// route masterdata hari libur
Route::prefix('/admin/holiday')->group(function() {
    Route::get('/',[HolidayController::class, 'index']);
    Route::get('/add',[HolidayController::class, 'create']);
    Route::post('/',[HolidayController::class, 'store']);
    Route::get('/{holiday}/edit',[HolidayController::class, 'edit']);
    Route::put('/{holiday}',[HolidayController::class, 'update']);
    Route::delete('/',[HolidayController::class, 'destroy']);
    Route::get('/search',[HolidayController::class, 'search']);
});

//route masterdata tipe potongan dan tunjangan
Route::prefix('/admin/cuts-allowances')->group(function(){
    Route::get('/',[CutAllowanceTypeController::class,'index']);
    Route::get('/add',[CutAllowanceTypeController::class,'create']);
    Route::post('/', [CutAllowanceTypeController::class, 'store']);
    Route::get('/{type}/edit', [CutAllowanceTypeController::class, 'edit']);
    Route::put('/{type}', [CutAllowanceTypeController::class, 'update']);
    Route::put('/{type}/status', [CutAllowanceTypeController::class, 'toogle_status']);
    Route::delete('/', [CutAllowanceTypeController::class, 'destroy']);
    Route::get('/search',[CutAllowanceTypeController::class, 'search']);
});

//route masterdata lembur
Route::prefix('/admin/overtime')->group(function(){
    Route::get('/',[OvertimeController::class,'index']);
    Route::get('/create',[OvertimeController::class,'create']);
});

//route masterdata potongan gaji
Route::prefix('/admin/salary-cut')->group(function(){
    Route::get('/',[SalaryCutController::class,'index']);
    Route::get('/add',[SalaryCutController::class,'create']);
    Route::post('/', [SalaryCutController::class, 'store']);
    Route::get('/{cut}/edit', [SalaryCutController::class, 'edit']);
    Route::put('/{cut}', [SalaryCutController::class, 'update']);
    Route::delete('/', [SalaryCutController::class, 'destroyAll']);
    Route::get('/search',[SalaryCutController::class, 'search']);
});

//route gaji admin
Route::prefix('/admin/salary')->group(function(){
    Route::get('/',[SalaryController::class,'index']);
    Route::post('/',[SalaryController::class,'list_data']);
    Route::post('/slip',[SalaryController::class,'create_slip']);
    Route::post('/processed',[SalaryController::class,'get_salary']);
    Route::post('/reset',[SalaryController::class,'reset_salary']);
});

//route gaji staff
Route::prefix('/staff/salary')->group(function(){
    Route::get('/',[SalaryController::class,'index_staff']);
});

//route masterdata tunjangan gaji
Route::prefix('/admin/salary-allowance')->group(function(){
    Route::get('/',[SalaryAllowanceController::class,'index']);
    Route::get('/add',[SalaryAllowanceController::class,'create']);
    Route::post('/', [SalaryAllowanceController::class, 'store']);
    Route::get('/{allowance}/edit', [SalaryAllowanceController::class, 'edit']);
    Route::put('/{allowance}', [SalaryAllowanceController::class, 'update']);
    Route::delete('/', [SalaryAllowanceController::class, 'destroyAll']);
    Route::get('/search',[SalaryAllowanceController::class, 'search']);
});

//route jadwal kerja admin & staff
Route::prefix('/admin/schedule')->group(function() {
    Route::get('/',[MasterJobScheduleController::class, 'index_month']);
    Route::post('/search',[MasterJobScheduleController::class, 'result_calendar']);
    Route::get('/add',[MasterJobScheduleController::class, 'filter']);
    Route::get('/edit',[MasterJobScheduleController::class, 'filter_edit']);
    Route::post('/add-schedule',[MasterJobScheduleController::class, 'schedule_add']);
    Route::post('/edit-schedule',[MasterJobScheduleController::class, 'schedule_edit']);
    Route::post('/post',[MasterJobScheduleController::class, 'schedule_post']);
    Route::get('/copyschedule',[MasterJobScheduleController::class,'CopySchedule']);
    Route::POST('/copyschedule/calculate',[MasterJobScheduleController::class,'ajaxCal']);
    Route::GET('/copyschedule/calculates',[MasterJobScheduleController::class,'ajaxCheckBox']);
    Route::post('/edit-post',[MasterJobScheduleController::class, 'edit_post']);
    Route::post('/copied',[MasterJobScheduleController::class,'copied']);
});
Route::prefix('/staff/schedule')->group(function() {
    Route::get('/',[MasterJobScheduleController::class, 'staff_calendar']);
    Route::post('/search',[MasterJobScheduleController::class, 'result_calendar']);
    Route::get('/add',[MasterJobScheduleController::class, 'filter']);
    Route::get('/edit',[MasterJobScheduleController::class, 'filter_edit']);
    Route::post('/add-schedule',[MasterJobScheduleController::class, 'schedule_add']);
    Route::post('/edit-schedule',[MasterJobScheduleController::class, 'schedule_edit']);
    Route::post('/post',[MasterJobScheduleController::class, 'schedule_post']);
    Route::post('/edit-post',[MasterJobScheduleController::class, 'edit_post']);
    Route::get('/division',[MasterJobScheduleController::class, 'index_month']);

    Route::get('/copyschedule',[MasterJobScheduleController::class,'ChiefCopySchedule']);
    Route::POST('/copyschedule/calculate',[MasterJobScheduleController::class,'ajaxCal']);
    Route::GET('/copyschedule/calculates',[MasterJobScheduleController::class,'ajaxCheckBox']);
    Route::post('/copied',[MasterJobScheduleController::class,'Chiefcopied']);
});

//route transaksi cuti ==ADMIN==
Route::prefix('/admin/paid-leave')->group(function(){
    Route::get('/',[TransactionPaidLeaveController::class,'index']);
    Route::get('/history',[TransactionPaidLeaveController::class,'history']);
    Route::put('/approve',[TransactionPaidLeaveController::class,'update_approve']);
    Route::put('/pending',[TransactionPaidLeaveController::class,'update_pending']);
    Route::put('/{reject}/reject',[TransactionPaidLeaveController::class,'reject']);
    Route::delete('/delete',[TransactionPaidLeaveController::class,'destroy']);
});

//route transaksi cuti ==STAFF==
Route::prefix('/staff/paid-leave')->group(function(){
    Route::get('/',[TransactionPaidLeaveController::class,'create']);
    Route::post('/',[TransactionPaidLeaveController::class,'store']);
    Route::get('/history',[TransactionPaidLeaveController::class,'show']);
    Route::get('/calculate',[TransactionPaidLeaveController::class,'calculate']);
    Route::get('/{id}/cancel',[TransactionPaidLeaveController::class,'cancel_staff']);
});

//route transaksi cuti ==STAFF==
Route::prefix('/staff/paid-leave/division')->group(function(){
    Route::get('/',[TransactionPaidLeaveController::class,'division']);
    Route::get('/history',[TransactionPaidLeaveController::class,'division_history']);
    Route::put('/approve',[TransactionPaidLeaveController::class,'division_approve']);
    Route::put('/pending',[TransactionPaidLeaveController::class,'division_pending']);
    Route::put('/{reject}/reject',[TransactionPaidLeaveController::class,'division_reject']);
});

//route transaksi wfh ==ADMIN==
Route::prefix('/admin/wfh')->group(function(){
    Route::get('/',[WorkFromHomeController::class,'index']);
    Route::get('/history',[WorkFromHomeController::class,'history']);
    Route::put('/approve',[WorkFromHomeController::class,'update_approve']);
    Route::put('/pending',[WorkFromHomeController::class,'update_pending']);
    Route::put('/{reject}/reject',[WorkFromHomeController::class,'reject']);
    Route::delete('/delete',[WorkFromHomeController::class,'destroy']);
});

//route transaksi wfh ==STAFF==
Route::prefix('/staff/wfh')->group(function(){
    Route::get('/',[WorkFromHomeController::class,'create']);
    Route::post('/',[WorkFromHomeController::class,'store']);
    Route::get('/history',[WorkFromHomeController::class,'show']);
    Route::get('/calculate',[WorkFromHomeController::class,'calculate']);
    Route::get('/{id}/cancel',[WorkFromHomeController::class,'cancel_staff']);
});

//route transaksi wfh ==STAFF==
Route::prefix('/staff/wfh/division')->group(function(){
    Route::get('/',[WorkFromHomeController::class,'division']);
    Route::get('/history',[WorkFromHomeController::class,'division_history']);
    Route::put('/approve',[WorkFromHomeController::class,'division_approve']);
    Route::put('/pending',[WorkFromHomeController::class,'division_pending']);
    Route::put('/{reject}/reject',[WorkFromHomeController::class,'division_reject']);
});

//route transaksi lembur ==ADMIN==
Route::prefix('/admin/overtime')->group(function(){
    Route::get('/',[OvertimeController::class,'index']);
    Route::get('/add',[OvertimeController::class,'create']);
    Route::post('/',[OvertimeController::class,'ajaxList']);
    Route::post('/store',[OvertimeController::class,'store']);
});

//route transaction ticketing ==ADMIN==
Route::prefix('/admin/ticketing')->group(function (){
    Route::get('/',[TransactionTicketingController::class,'admin_index']);
    Route::get('/{ticket}/edit',[TransactionTicketingController::class,'admin_edit']);
    Route::put('/on-progress',[TransactionTicketingController::class,'make_on_progress']);
    Route::put('/{ticket}',[TransactionTicketingController::class,'admin_response']);
    Route::delete('/',[TransactionTicketingController::class,'admin_delete']);
    Route::get('/search',[TransactionTicketingController::class,'admin_search']);
});

//route transaction ticketing ==STAFF==
Route::prefix('/staff/ticketing')->group(function (){
    Route::get('/',[TransactionTicketingController::class,'staff_index']);
    Route::get('/create',[TransactionTicketingController::class,'staff_create']);
    Route::post('/input',[TransactionTicketingController::class,'staff_input']);
});

//route achievement ==ADMIN==
Route::prefix('/admin/achievement')->group(function () {
    Route::get('/', [App\Http\Controllers\MasterAchievementController::class,'index']);
    Route::get('/scoring',[MasterAchievementController::class,'scoring']);
    Route::get('/searchlist',[MasterAchievementController::class,'searchlist']);
    Route::post('/scoring',[MasterAchievementController::class,'scored']);
    Route::post('/search',[MasterAchievementController::class,'search']);
    Route::get('/charts', [MasterAchievementController::class,'admin_chart_index']);
});

//Route Achievement ==Chief==
Route::prefix('/staff/achievement')->group(function () {
    Route::get('/', [MasterAchievementController::class,'indexChief']);
    Route::get('/scoring',[MasterAchievementController::class,'chiefScoring']);
    Route::get('/searchlist',[MasterAchievementController::class,'Chiefsearchlist']);
    Route::post('/scoring',[MasterAchievementController::class,'chiefScored']);
    Route::post('/search',[MasterAchievementController::class,'ChiefSearch']);
    Route::get('/Charts', [MasterAchievementController::class,'chief_chart_index']);
});
//route achievement ==STAFF==

//route staff presence
Route::prefix('/staff/presence')->group(function () {
    Route::get('/',[PresenceController::class,'staff_view']);
    Route::post('/search',[PresenceController::class,'search']);
    Route::post('/add',[PresenceController::class,'add_presence']);
});

//route sistem poster
Route::prefix('/admin/poster')->group(function(){
    Route::get('/',[SliderController::class,'index']);
    Route::get('/add',[SliderController::class,'create']);
    Route::post('/add',[SliderController::class,'store']);
    Route::delete('/',[SliderController::class,'destroySelected']);
    Route::get('/{poster}/edit', [SliderController::class, 'edit']);
    Route::put('/{poster}', [SliderController::class, 'update']);
});

//route sistem log
Route::prefix('/admin/log')->group(function(){
    Route::get('/',[LogController::class,'index']);
    Route::get('/search',[LogController::class,'search']);
    Route::delete('/',[LogController::class,'destroyselected']);
    Route::get('/autodelete',[LogController::class,'AutoDeleteLogs']);
});

//route masterdata job
Route::prefix('/admin/job')->group(function (){
    Route::get('/',[ MasterJobController::class,'indexJob']);
    Route::post('/',[ MasterJobController::class,'store']);
    Route::get('/add',[ MasterJobController::class,'create']);
    Route::get('/search',[ MasterJobController::class,'search']);
    Route::delete('/delete',[ MasterJobController::class,'destroy']);
});

//route recruitment
Route::get('/admin/recruitment',[ MasterRecruitmentController::class,'index']);
Route::get('/admin/recruitment/search', [MasterRecruitmentController::class,'search']);
Route::delete('/admin/recruitment/delete', [MasterRecruitmentController::class,'destroySelected']);


Route::get('/admin/presence', [PresenceController::class,'getProcessedPresenceView']);
Route::post('/admin/presence/processed', [PresenceController::class,'viewProcessedPresence']);
Route::post('/admin/presence/reset', [PresenceController::class,'resetStats']);

Route::view('/test', 'pdf.salary');
Route::get('/test/hitung',[AgendaController::class,'test']);
