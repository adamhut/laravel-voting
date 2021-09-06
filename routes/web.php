<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController;

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
// auth()->logout();
// Route::get('/', function () {
//     return view('index');
// });

Route::get('/',[IdeaController::class,'index'])->name('idea.index');

Route::get('/ideas/{idea:slug}', [IdeaController::class, 'show'])->name('idea.show');


Route::view('/laracasts/reproduce/menu-transitions', 'laracasts.menu-transitions');

Route::view('/laracasts/reproduce/image-pin-while-scrolling', 'laracasts.image-pin-while-scrolling');

Route::view('/laracasts/reproduce/event-list', 'laracasts.event-list');

Route::view('/laracasts/headless-ui/menu-dropdown', 'laracasts.menu-dropdown');
Route::view('/laracasts/headless-ui/modal', 'laracasts.modal');

Route::view('/laracasts/headless-ui/radio-group', 'laracasts.radio-group');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
