<?php

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
    return redirect('/home');
});

//后台
Route::get('/admin/index', 'Admin\IndexController@index');
Route::get('/admin/login', 'Admin\IndexController@login');
Route::any('/admin/loginRes', 'Admin\IndexController@loginRes');
Route::any('/admin/loginout', 'Admin\IndexController@loginout');
Route::any('/settingApi/{type}', 'Admin\SettingController@settingApi');


//添加校友
Route::any('/apiAddXiaoyou', 'Admin\XiaoweihuiController@apiAddXiaoyou');
//获取校友会列表
Route::any('/apiXiaoyouList', 'Admin\XiaoweihuiController@apiXiaoyouList');
//通过校友会id 获取校友会详情
Route::any('/apiXiaoyouhuiDetail/{id}', 'Admin\XiaoweihuiController@getDetailById');
//通过校友会id  返回通讯录
Route::any('/apiXiaoyouDetail', 'Admin\XiaoweihuiController@apiXiaoyouDetail');
//通过校友会id  返回通讯录2
Route::any('/apiXiaoyouDetail2', 'Admin\XiaoweihuiController@apiXiaoyouDetail2');
//通过校友会id 返回搜索列表
Route::any('/searchXiaoyou', 'Admin\XiaoweihuiController@searchXiaoyou');
//删除校友会
Route::any('/deleteXiaoyouhui/{id}', 'Admin\XiaoweihuiController@deleteXiaoyouhui');
//加入校友会
Route::any('/apiEnterXiaoyou', 'Admin\XiaoweihuiController@apiEnterXiaoyou');
//加入校友会
Route::any('/getXiaoyouhuiManage/{id}', 'Admin\XiaoweihuiController@getXiaoyouhuiManage');



//获取学校
Route::any('/apiSchool', 'Admin\SchoolController@apiSchool');
//添加用户
Route::any('/apiAddUser', 'Admin\UserController@apiAddUser');
//编辑名片
Route::any('/apiEditUser', 'Admin\UserController@apiEditUser');
//通过openid 拿到userinfo
Route::any('/apiUserInfo', 'Admin\UserController@apiUserInfo');
//添加活动
Route::any('/apiAddActivity', 'Admin\ActivityController@apiAddActivity');
//活动列表
Route::any('/apiActivityList', 'Admin\ActivityController@apiActivityList');
//过期活动列表
Route::any('/apiEndActivityList', 'Admin\ActivityController@apiEndActivityList');
//删除活动
Route::any('/deleteActivity/{id}', 'Admin\ActivityController@deleteActivity');
//活动详情
Route::any('/apiActivityDetail', 'Admin\ActivityController@apiActivityDetail');
//wxlogin
Route::any('/apiCheckLogin/{code}','ApiController@checkLogin');
//活动报名
Route::any('/apiBaoming','Admin\ActivityController@apiBaoming');
//添加用户
Route::any('/getOpenGid', 'Admin\UserController@getOpenGid');
//获取群ID
Route::any('/getopenID', 'Admin\UserController@getopenID');
//Richer 上传图片
Route::any('/saveImg','Admin\ActivityController@saveImg');

//添加/更新公告
Route::any('/addNotice', 'Admin\NoticeController@addNotice');
//删除公告
Route::any('/deleteNotice', 'Admin\NoticeController@deleteNotice');
//查询公告
Route::any('/getNotice', 'Admin\NoticeController@getNotice');
//查询邀请码
Route::any('/getInvotCode', 'Admin\SettingController@getInvotCode');




//Route::group(['as' => 'setting','middleware' => ['checklogin']], function () {
//    Route::any('/admin/setting/{type}', 'Admin\SettingController@index');
//
//    Route::any('/admin/addSettingRes', 'Admin\SettingController@addSettingRes');
//    Route::any('/admin/deleteSetting/{id}/{type}', 'Admin\SettingController@deleteSetting');
//});


Route::group(['as' => 'setting','middleware' => ['checklogin']], function () {
    Route::any('/admin/setting/{type}', 'Admin\SettingController@index');
    Route::any('/admin/invitcodeSetting', 'Admin\SettingController@invitcodeSetting');
    Route::any('/admin/addInvitCode', 'Admin\SettingController@addInvitCode');
    Route::any('/admin/deleteInvitCode/{id}', 'Admin\SettingController@deleteInvitCode');
    Route::any('/admin/setInvitLose/{id}', 'Admin\SettingController@setInvitLose');
    Route::any('/admin/addSettingRes', 'Admin\SettingController@addSettingRes');
    Route::any('/admin/deleteSetting/{id}/{type}', 'Admin\SettingController@deleteSetting');
});

Route::group(['as' => 'school','middleware' => ['checklogin']], function () {
    Route::any('/admin/school', 'Admin\SchoolController@index');
    Route::any('/admin/addSchool', 'Admin\SchoolController@addSchool');
    Route::any('/admin/addSchoolRes', 'Admin\SchoolController@addSchoolRes');
    Route::any('/admin/editSchool/{id}', 'Admin\SchoolController@editSchool');
    Route::any('/admin/editSchoolRes', 'Admin\SchoolController@editSchoolRes');
    Route::any('/admin/deleteSchool/{id}', 'Admin\SchoolController@deleteSchool');
});

Route::group(['as' => 'xiaoweihui','middleware' => ['checklogin']], function () {
    Route::any('/admin/xiaoweihui', 'Admin\XiaoweihuiController@index');
    Route::any('/admin/exportXiaoweihui/{id}', 'Admin\XiaoweihuiController@exportXiaoweihui');
});

Route::group(['as' => 'user','middleware' => ['checklogin']], function () {
    Route::any('/admin/user', 'Admin\UserController@index');
    Route::any('/admin/user/userdetail/{id}', 'Admin\UserController@userdetail');
});

Route::group(['as' => 'activity','middleware' => ['checklogin']], function () {
    Route::any('/admin/activity', 'Admin\ActivityController@index');
    Route::any('/admin/exportExcel', 'Admin\ActivityController@exportExcel');
    Route::any('/admin/exportPersonList/{id}', 'Admin\ActivityController@exportPersonList');
});
Route::get('test', function () {
    return 'TEST';
});






