<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\RuleController;
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
    return view('welcome');
});

Route::get('entry', [EntryController::class, 'index'])->name('entry');

Route::post('entry/import', [EntryController::class, 'import'])->name('import');

Route::get('entry/aknowledge/{id}', [EntryController::class, 'aknowledge'])->name('aknowledge');

Route::get('entry/aknowledgeGroup/{source_ip}/{protocol_transport}/{source_port}', [EntryController::class, 'aknowledgeGroup'])->name('aknowledgeGroup');

Route::post('rule/add', [RuleController::class, 'add'])->name('addRule');

Route::get('rule/save/{source_ip}/{protocol_transport}/{source_port}', [RuleController::class, 'save'])->name('saveRule');