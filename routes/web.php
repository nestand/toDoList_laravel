<?php
use app\tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;


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
        $tasks = tasks::orderBy('created_at', 'asc')->get();
        return view('tasks', ["tasks" => $tasks]);
    });

    Route::post('/tasks', function (Request $request) {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if($validator->fails()){
            return redirect('/')->withInput();
        }

        $task = new tasks();
        $task->name = $request->name;
        $task->save();

        return redirect('/');
    });

    Route::delete('/tasks/{task}', function (tasks $task) {
        $task->delete();
        return redirect('/');
    });



});