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

Route::group(['middleware' => 'web'], function (){
    Route::get('/', function () {
    $tasks = Tasks::orderBy('created_at', 'asc')->get();
        return view ('tasks', ["tasks"=>$tasks]);
 });
    Route::post('/tasks', function (Request $request) {
    //
    $validator = Validator::make($request->all(), [
        'name' => 'required|max255'
    ]);
    if ($validator -> fails()){
        return redirect('/')->withInput();
    }
    $task = new Tasks();
    $task -> name = $request -> name;
    $task -> save();
    
    return redirect('/'); 
 });
     Route::delete('/tasks{task}', function (Tasks $task) {
    $task ->delete();
    return redirect('/');
 });
});