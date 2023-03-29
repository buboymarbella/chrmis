<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes(['register' => false]);
Route::get('logout', 'Auth\LoginController@logout');
//Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', 'MainController\MasterController@index');

    //Admin Controller
    Route::resource('users', 'AdminController\UserController');
    Route::resource('usernames', 'AdminController\UsernameController')->except('index','create','store','show','destroy');
    Route::resource('passwords', 'AdminController\PasswordController')->except('index','create','store','show','destroy');
    Route::get('/view_deleted_records', 'AdminController\AdminController@view_deleted_records')->name('view_deleted_records');
    Route::get('/restore_delete_record/{id}', 'AdminController\AdminController@restore_delete_record')->name('restore_delete_record');
    Route::get('/permanent_delete_record/{id}', 'AdminController\AdminController@permanent_delete_record')->name('permanent_delete_record');
    Route::get('/ctg_csv', 'AdminController\AdminController@add_ctg_csv')->name('ctg_csv');
    Route::post('/save_ctg_csv', 'AdminController\AdminController@save_ctg_csv')->name('save_ctg_csv');
    Route::get('/ltg_csv', 'AdminController\AdminController@add_ltg_csv')->name('ltg_csv');
    Route::post('/save_ltg_csv', 'AdminController\AdminController@save_ltg_csv')->name('save_ltg_csv');
    Route::get('/view_logs', 'AdminController\AdminController@view_logs')->name('view_logs');
    Route::get('/delete_logs', 'AdminController\AdminController@delete_logs')->name('delete_logs');
    Route::get('/search_deleted_chr', 'AdminController\AdminController@search_deleted_chr')->name('search_deleted_chr');

    //Main Menu Routes
    Route::resource('masters', 'MainController\MasterController');
    Route::resource('addresses', 'MainController\AddressController');
    Route::resource('answers', 'MainController\AnswerController');
    Route::resource('commendations', 'MainController\CommendationController');
    Route::resource('contacts', 'MainController\ContactController');
    Route::resource('educations', 'MainController\EducationController');
    Route::resource('colleges', 'MainController\CollegeController');
    Route::resource('vocationals', 'MainController\VocationalController');
    Route::resource('graduates', 'MainController\GraduateController');
    Route::resource('eligibilities', 'MainController\EligibilityController');
    Route::resource('fathers', 'MainController\FatherController');
    Route::resource('mothers', 'MainController\MotherController');
    Route::resource('childrens', 'MainController\ChildController');
    Route::resource('spouses', 'MainController\SpouseController');
    Route::resource('issues', 'MainController\IssueController');
    Route::resource('items', 'MainController\ItemController');
    Route::resource('others', 'MainController\OtherController');
    Route::resource('photos', 'MainController\PhotoController');
    Route::resource('ratings', 'MainController\RatingController');
    Route::resource('plantillas', 'MainController\PlantillaController');
    Route::resource('references', 'MainController\ReferenceController');
    Route::resource('trainings', 'MainController\TrainingController');
    Route::resource('units', 'MainController\UnitController');
    Route::resource('voluntaries', 'MainController\VoluntaryController');
    Route::resource('works', 'MainController\WorkController');
    Route::resource('costings', 'MainController\CostingController');
    Route::resource('performances', 'MainController\PerformanceController');
    Route::resource('educations', 'MainController\EducationController')->except('index','create','destroy');
    Route::resource('families', 'MainController\FamilyController')->except('index','create','destroy');

    //SidebarController
    Route::get('/autocomplete', 'PlantillaController@autocomplete')->name('autocomplete');
    Route::get('/view_records', 'SidebarController@view_records')->name('view_records');
    Route::get('/image_gallery', 'SidebarController@image_gallery')->name('image_gallery');
    Route::get('/report_personalities', 'SidebarController@report_personalities')->name('report_personalities');

    //Profile Route
    Route::get('/education/{id}', 'MainController\MasterController@show')->name('education');
    Route::get('/history/{id}', 'MainController\MasterController@show')->name('history');
    Route::get('/families_records/{id}', 'MainController\MasterController@show')->name('families_records');
    Route::get('/eligibility/{id}', 'MainController\MasterController@show')->name('eligibility');
    Route::get('/workexpe/{id}', 'MainController\MasterController@show')->name('workexpe');
    Route::get('/voluntary/{id}', 'MainController\MasterController@show')->name('voluntary');
    Route::get('/skills/{id}', 'MainController\MasterController@show')->name('skills');
    Route::get('/commendation/{id}', 'MainController\MasterController@show')->name('commendation');
    Route::get('/other_info/{id}', 'MainController\MasterController@show')->name('other_info');
    Route::get('/reference/{id}', 'MainController\MasterController@show')->name('reference');
    Route::get('/rating/{id}', 'MainController\MasterController@show')->name('rating');
    Route::get('/training/{id}', 'MainController\MasterController@show')->name('training');
    Route::get('/issued/{id}', 'MainController\MasterController@show')->name('issued');
    Route::get('/performance/{id}', 'MainController\MasterController@show')->name('performance');

    //Print PDF
    Route::get('/print_personalities/{id}', 'PrintRecord\PrintRecord@print_personalities')->name('print_personalities');
    Route::get('/print_pds_page1/{id}', 'PrintRecord\PrintRecord@print_pds_page1')->name('print_pds_page1');
    Route::get('/print_pds_page2/{id}', 'PrintRecord\PrintRecord@print_pds_page2')->name('print_pds_page2');
    Route::get('/print_pds_page3/{id}', 'PrintRecord\PrintRecord@print_pds_page3')->name('print_pds_page3');
    Route::get('/print_pds_page4/{id}', 'PrintRecord\PrintRecord@print_pds_page4')->name('print_pds_page4');
    Route::get('/print_pds_page5/{id}', 'PrintRecord\PrintRecord@print_pds_page5')->name('print_pds_page5');
    Route::get('/print_pds_page6/{id}', 'PrintRecord\PrintRecord@print_pds_page6')->name('print_pds_page6');
    Route::get('/training_cport', 'PrintRecord\PrintRecord@training_cport')->name('training_cport');
    Route::get('/training_cpbc', 'PrintRecord\PrintRecord@training_cpbc')->name('training_cpbc');
    Route::get('/training_cpbsc', 'PrintRecord\PrintRecord@training_cpbsc')->name('training_cpbsc');
    Route::get('/training_cpasc', 'PrintRecord\PrintRecord@training_cpasc')->name('training_cpasc');
    Route::post('/advanced_result', 'PrintRecord\PrintRecord@advanced_result')->name('advanced_result');
    Route::get('/view_advanced_result', 'PrintRecord\PrintRecord@view_advanced_result')->name('view_advanced_result');
    Route::post('/performance_mgt_monitoring_report', 'PrintRecord\PrintRecord@performance_mgt_monitoring_report')->name('performance_mgt_monitoring_report');

    //Search
    Route::get('/search_plantilla', 'MainController\SearchController@search_plantilla')->name('search_plantilla');
    Route::get('/search_staff_plan', 'MainController\SearchController@search_staff_plan')->name('search_staff_plan');
    Route::get('/search_comp_matrix/{id}', 'MainController\SearchController@search_comp_matrix')->name('search_comp_matrix');
    Route::get('/main_search', 'MainController\SearchController@main_search')->name('main_search');
    Route::get('/advance_search', 'MainController\SearchController@advance_search')->name('advance_search');
    Route::get('/search_log', 'MainController\SearchController@search_log')->name('search_log');
    Route::get('/search_chr', 'MainController\SearchController@search_chr')->name('search_chr');
    Route::get('/search_tat', 'MainController\SearchController@search_tat')->name('search_tat');
    Route::get('/advanced_search', 'MainController\SearchController@advanced_search')->name('advanced_search');
    Route::get('/organization_search', 'MainController\SearchController@organization_search')->name('organization_search');
    Route::get('/result_cport', 'MainController\SearchController@result_cport')->name('result_cport');
    Route::get('/result_cpbc', 'MainController\SearchController@result_cpbc')->name('result_cpbc');
    Route::get('/result_cpbsc', 'MainController\SearchController@result_cpbsc')->name('result_cpbsc');
    Route::get('/result_cpasc', 'MainController\SearchController@result_cpasc')->name('result_cpasc');
    Route::get('/result_tat_costing_report', 'MainController\SearchController@result_tat_costing_report')->name('result_tat_costing_report');
    // Route::get('/result_tat_costing_report', 'MainController\SearchController@result_tat_costing_report')->name('result_tat_costing_report');
    Route::get('/result_training_accomp_report', 'MainController\SearchController@result_training_accomp_report')->name('result_training_accomp_report');
    Route::any('/awards_demog_report', 'MainController\SearchController@awards_demog_report')->name('awards_demog_report');

    //Report
    Route::get('/training_matrix', 'SidebarController@training_matrix')->name('training_matrix');
    Route::get('/tat_costing_report', 'SidebarController@tat_costing_report')->name('tat_costing_report');
    Route::get('/training_accomp_report', 'SidebarController@training_accomp_report')->name('training_accomp_report');
    Route::get('/view_tat_records', 'SidebarController@view_tat_records')->name('view_tat_records');
    Route::get('/staffing_plan', 'SidebarController@staffing_plan')->name('staffing_plan');
    Route::get('/staffing_office_plan/{id}', 'SidebarController@staffing_office_plan')->name('staffing_office_plan');
    Route::get('/fill_up_rate_date', 'SidebarController@fill_up_rate_date')->name('fill_up_rate_date');
    Route::any('/fill_up_rate', 'SidebarController@fill_up_rate')->name('fill_up_rate');
    Route::get('/fill_up_rate_office_report/{id}', 'SidebarController@fill_up_rate_office_report')->name('fill_up_rate_office_report');
    Route::get('/demographics', 'SidebarController@demographics')->name('demographics');
    Route::post('/demographics_result', 'MainController\SearchController@demographics_result')->name('demographics_result');
    Route::any('/rating_report', 'MainController\SearchController@rating_report')->name('rating_report');
    // Route::get('/get_outstanding', 'MainController\RatingResultOutstanding@get_outstanding')->name('get_outstanding');
    Route::get('/performance_rating', 'SidebarController@performance_rating')->name('performance_rating');
    Route::get('/computer_asst_matrix', 'SidebarController@computer_asst_matrix')->name('computer_asst_matrix');
    Route::get('/computer_asst_matrix_office/{id}', 'SidebarController@computer_asst_matrix_office')->name('computer_asst_matrix_office');
    Route::get('/comp_asst_matrix_vacant_pos/{id}', 'SidebarController@comp_asst_matrix_vacant_pos')->name('comp_asst_matrix_vacant_pos');
    Route::get('/awards_demog_date', 'SidebarController@awards_demog_date')->name('awards_demog_date');
    Route::post('/awards_demog_national', 'SidebarController@awards_demog_national')->name('awards_demog_national');
    Route::post('/awards_demog_honor', 'SidebarController@awards_demog_honor')->name('awards_demog_honor');
    Route::post('/awards_demog_incentives', 'SidebarController@awards_demog_incentives')->name('awards_demog_incentives');
    Route::get('/performance_mgt_monitoring', 'SidebarController@performance_mgt_monitoring')->name('performance_mgt_monitoring');


    //Download and Print
    Route::get('/training_cport_download', 'PrintRecord\PrintRecord@training_cport_download')->name('training_cport_download');
    Route::get('/training_cpbc_download', 'PrintRecord\PrintRecord@training_cpbc_download')->name('training_cpbc_download');
    Route::get('/training_cpbsc_download', 'PrintRecord\PrintRecord@training_cpbsc_download')->name('training_cpbsc_download');
    Route::get('/training_cpasc_download', 'PrintRecord\PrintRecord@training_cpasc_download')->name('training_cpasc_download');
    Route::get('/rating_download/{id}', 'PrintRecord\PrintRecord@rating_download')->name('rating_download');
    Route::get('/download_staffing_result/{id}', 'PrintRecord\PrintRecord@download_staffing_result')->name('download_staffing_result');
    Route::post('/print_demog_result_bt', 'PrintRecord\PrintRecord@print_demog_result_bt')->name('print_demog_result_bt');
    Route::post('/print_demog_result_cs', 'PrintRecord\PrintRecord@print_demog_result_cs')->name('print_demog_result_cs');
    Route::post('/print_demog_result_ig', 'PrintRecord\PrintRecord@print_demog_result_ig')->name('print_demog_result_ig');
    Route::post('/print_demog_result_pwd', 'PrintRecord\PrintRecord@print_demog_result_pwd')->name('print_demog_result_pwd');
    Route::post('/print_demog_result_sex', 'PrintRecord\PrintRecord@print_demog_result_sex')->name('print_demog_result_sex');
    Route::post('/print_demog_result_sp', 'PrintRecord\PrintRecord@print_demog_result_sp')->name('print_demog_result_sp');
    Route::post('/print_demog_result_te', 'PrintRecord\PrintRecord@print_demog_result_te')->name('print_demog_result_te');
    Route::post('/download_demog_result_yb', 'PrintRecord\PrintRecord@download_demog_result_yb')->name('download_demog_result_yb');
    Route::post('/download_demog_result_yr', 'PrintRecord\PrintRecord@download_demog_result_yr')->name('download_demog_result_yr');
    Route::post('/download_demog_result_ys', 'PrintRecord\PrintRecord@download_demog_result_ys')->name('download_demog_result_ys');
    Route::post('/download_result_outstanding', 'PrintRecord\PrintRecord@download_result_outstanding')->name('download_result_outstanding');
    Route::post('/download_result_satisfactory', 'PrintRecord\PrintRecord@download_result_satisfactory')->name('download_result_satisfactory');
    Route::post('/download_result_poor', 'PrintRecord\PrintRecord@download_result_poor')->name('download_result_poor');
    Route::post('/download_national_award', 'PrintRecord\PrintRecord@download_national_award')->name('download_national_award');
    Route::post('/download_incentives_award', 'PrintRecord\PrintRecord@download_incentives_award')->name('download_incentives_award');
    Route::post('/download_honor_award', 'PrintRecord\PrintRecord@download_honor_award')->name('download_honor_award');
    Route::get('/download_staffing_office_plan/{id}', 'PrintRecord\PrintRecord@download_staffing_office_plan')->name('download_staffing_office_plan');
    Route::post('/download_tat_costing', 'PrintRecord\PrintRecord@download_tat_costing')->name('download_tat_costing');
    Route::get('/download_computer_asst_matrix/{id}', 'PrintRecord\PrintRecord@download_computer_asst_matrix')->name('download_computer_asst_matrix');

    Route::get('/add_test', 'AdminController\AdminController@add_test')->name('add_test');
    Route::post('/save_test', 'AdminController\AdminController@save_test')->name('save_test');

    #SESSION
    Route::get('comp/{id}','SidebarController@addToComp')->name('comp');
    Route::delete('remove-from-cart', 'SidebarController@remove')->name('remove.from.cart');

    #UPDATE DATE HIRED
    Route::get('/update_date_hired', 'MainController\MasterController@update_date_hired')->name('update_date_hired');
    Route::get('/view_records_2', 'SidebarController@view_records_2')->name('view_records_2');
    Route::post('/awards_demog_incentives', 'SidebarController@v@awards_demog_incentives_2')->name('awards_demog_incentives_2');
});