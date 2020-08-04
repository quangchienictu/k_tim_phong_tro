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
use App\User;
use App\District;
use App\Categories;
use App\Motelroom;
use App\rating;
Route::get('/', function () {
	$district = District::all();
    $categories = Categories::all();
    $hot_motelroom = Motelroom::where('approve',1)->where('status',0)->limit(6)->orderBy('count_view','desc')->get();
    $map_motelroom = Motelroom::where('approve',1)->where('status',0)->get();
	$listmotelroom = Motelroom::where('approve',1)->where('status',0)->paginate(4);
    return view('home.index',[
    	'district'=>$district,
        'categories'=>$categories,
        'hot_motelroom'=>$hot_motelroom,
    	'map_motelroom'=>$map_motelroom,
        'listmotelroom'=>$listmotelroom
    ]);
});
Route::get('category/{id}','MotelController@getMotelByCategoryId');
/* Admin */
Route::get('admin/login','AdminController@getLogin');
Route::post('admin/login','AdminController@postLogin')->name('admin.login');
Route::group(['prefix'=>'admin','middleware'=>'adminmiddleware'], function () {
    Route::get('logout','AdminController@logout');
    Route::get('','AdminController@getIndex');
    Route::get('thongke','AdminController@getThongke');
    Route::get('report','AdminController@getReport');

    Route::group(['prefix'=>'users'],function(){
        Route::get('list','AdminController@getListUser');
        Route::get('edit/{id}','AdminController@getUpdateUser');
        Route::post('edit/{id}','AdminController@postUpdateUser')->name('admin.user.edit');
        Route::get('del/{id}','AdminController@DeleteUser');
        Route::get('pheduyet/{id}','AdminController@PheDuyet');
    });
    Route::group(['prefix'=>'motelrooms'],function(){
        Route::get('list','AdminController@getListMotel');
        Route::get('approve/{id}','AdminController@ApproveMotelroom');
        Route::get('unapprove/{id}','AdminController@UnApproveMotelroom');
        Route::get('del/{id}','AdminController@DelMotelroom');
        // Route::get('edit/{id}','AdminController@getUpdateUser');
        // Route::post('edit/{id}','AdminController@postUpdateUser')->name('admin.user.edit');
        // Route::get('del/{id}','AdminController@DeleteUser');
    });
    Route::group(['prefix'=>'rating'],function(){
        Route::get('/','AdminController@rating')->name('admin.rating.list');
        Route::get('list','AdminController@rating')->name('admin.rating.list');
        Route::get('check/{id}','AdminController@check_rating')->name('admin.rating.check');
        Route::get('delete/{id}','AdminController@delete_rating')->name('admin.rating.delete');
       /* Route::get('approve/{id}','AdminController@ApproveMotelroom');
        Route::get('unapprove/{id}','AdminController@UnApproveMotelroom');
        Route::get('del/{id}','AdminController@DelMotelroom');*/
     
    });
});
/* End Admin */
Route::get('/phongtro/{slug}',function($slug){
    $room = Motelroom::findBySlug($slug);
    $room->count_view = $room->count_view +1;
    $room->save();
    $rating =rating::where('id_motel',$room->id)->where('status',1) ->orderBy('created_at', 'desc')->limit(10)->get();
    $categories = Categories::all();
   
//    dd(json_decode($room->latlng,true));
    return view('home.detail',['motelroom'=>$room, 'categories'=>$categories,'rating'=>$rating]);
});
Route::get('/report/{id}','MotelController@userReport')->name('user.report');
Route::get('/motelroom/del/{id}','MotelController@user_del_motel');
Route::get('/user/del/{id}','MotelController@DelMotelroom')->name('user.deleteMotel')->middleware('dangtinmiddleware');
/* User */
Route::group(['prefix'=>'user'], function () {
    Route::get('register','UserController@get_register');
    Route::post('register','UserController@post_register')->name('user.register');

    Route::get('login','UserController@get_login');
    Route::post('login','UserController@post_login')->name('user.login');
    Route::get('logout','UserController@logout');
    Route::post('comment','UserController@comment')->name('user.comment')->middleware('dangtinmiddleware');
    Route::get('dangtin','UserController@get_dangtin')->middleware('dangtinmiddleware');
    Route::get('editdangtin/{id}','UserController@edit_dangtin')->name('user.editdangtin')->middleware('dangtinmiddleware');
    Route::post('editdangtin/{id}','UserController@edit_dangtin_post')->name('user.editdangtinpost')->middleware('dangtinmiddleware');
    Route::post('dangtin','UserController@post_dangtin')->name('user.dangtin')->middleware('dangtinmiddleware');
    Route::get('tindadang','UserController@tindadang')->name('user.tindadang')->middleware('dangtinmiddleware');
    Route::get('edittindadang/{id}','UserController@edittindadang')->name('user.edittindadang')->middleware('dangtinmiddleware');
    Route::get('profile','UserController@getprofile')->middleware('dangtinmiddleware');
    Route::get('profile/edit','UserController@getEditprofile')->middleware('dangtinmiddleware');
    Route::post('profile/edit','UserController@postEditprofile')->name('user.edit')->middleware('dangtinmiddleware');
});
/* ----*/

Route::post('searchmotel','MotelController@SearchMotelAjax');
