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
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(),
              'middleware' => [ 'localeSessionRedirect', 'localizationRedirect',
    'localeViewPath' ]
             ], function()
{
    Auth::routes();

    Route::get('/', function () {
        return view('wel', array(
            'appName' => 'Live Sea'
        ));
    });

    //Auth::routes();0677863366

    Route::get('/tasks', 'TaskController@index');
    Route::post('/task', 'TaskController@store');
    Route::get('/tasksAll', 'TaskController@indexAll');
    Route::delete('/task/{task}', 'TaskController@destroy');

    Route::resource('users','UserController');

    Route::get('/admin',function(Request $request){
        $user_role = DB::table('roles')->where('id',$request->user()->role)->first();
        //var_dump($user_role->name);
        if($user_role->name == 'administrator'){
            return view('admin.index');
            //echo ['users' => DB::table('users')->get()];
        }else{
            return view('wel', array(
                'appName' => 'Live Sea'
            ));
        }
    });
});

