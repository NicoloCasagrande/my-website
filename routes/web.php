<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
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

//Tutte le rotte pubbliche per cui non serve autenticazione
Route::get('/', function () {
    return view('welcome');
});

//Tutte le rotte 'private' che prevedono autenticazione
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $projects = Project::all();
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.dashboard', compact('projects', 'types', 'technologies'));
    })->name('dashboard');

    Route::resource('projects', ProjectController::class)->parameters(['projects' => 'project:slug']);
    Route::resource('types', TypeController::class)->parameters(['types' => 'type:slug']);
    Route::resource('technologies', TechnologyController::class)->parameters(['technologies' => 'technology:slug']);
});

//Tutte le rotte relative all'autenticazione
require __DIR__.'/auth.php';
