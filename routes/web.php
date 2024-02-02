<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GropController;
use App\Http\Controllers\InfowebsiteController;
use App\Http\Controllers\UserControllerr;
use App\Http\Controllers\ViewControoler;
use App\Http\Controllers\rejectWordController;
use App\Http\Controllers\DoorController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DoorMessegeController;
use App\Http\Middleware\dashbordMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Models\Admin;
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

// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================

Route::prefix('/')->group(function () {
    Route::get('/', [ViewControoler::class, 'index'])->name('index');
    Route::get('/panel', [ViewControoler::class, 'panel'])->name('panel')->middleware(UserMiddleware::class);
    Route::get('/info', [ViewControoler::class, 'info'])->name('info');
    Route::get('/recetPassViwe', [ViewControoler::class, 'recetPassViwe'])->name('recetPassViwe')->middleware(UserMiddleware::class);
    Route::prefix('user')->group(function () {
        //    ============  user regester ===========
        Route::post('/sendPhon', [UserControllerr::class, 'sendPhon'])->name('sendPhon');
        Route::post('/AuthStore', [UserControllerr::class, 'AuthStore'])->name('AuthStore');
        Route::post('/createUser', [UserControllerr::class, 'createUser'])->name('createUser');
        Route::get('/ticket', [ViewControoler::class, 'ticket'])->name('ticket')->middleware(UserMiddleware::class);
        //    ============  user regester ===========

        //    ============  user login logout ===========
        Route::post('/loginUser', [UserControllerr::class, 'loginUser'])->name('loginUser');
        Route::post('/logOutUser', [UserControllerr::class, 'logOutUser'])->name('logOutUser');
        Route::post('user/imageUpdate', [UserControllerr::class, 'imageUpdate'])->name('imageUpdate');
        //    ============  user login logout ===========
        //    ============  recet pass ===========
        Route::post('/recetUserPass', [UserControllerr::class, 'recetUserPass'])->name('recetUserPass');
        Route::post('/recetUserPassAuth', [UserControllerr::class, 'recetUserPassAuth'])->name('recetUserPassAuth');
        Route::post('/recetUserPsswordEnd', [UserControllerr::class, 'recetUserPsswordEnd'])->name('recetUserPsswordEnd');
        //    ============  recet pass ===========
        Route::post('/userupdate', [UserControllerr::class, 'userupdate'])->name('userupdate');
        Route::get('/panel/edit{id}', [UserControllerr::class, 'editInfoUser'])->name('editInfoUser');
    });


    // =============== panel door ==============
    Route::post('/panel/doorNwe', [DoorController::class, 'doorNwe'])->name('doorNwe');
    Route::post ('/panel/otherCity', [DoorController::class, 'otherCity'])->name('otherCity');
    Route::post('/cehckAcceptDoor/{id}', [DoorController::class, 'cehckAcceptDoor'])->name('cehckAcceptDoor');
    Route::get('/getSubGrop/{grop}', [GropController::class, 'getSubGrop'])->name('getSubGrop');
    Route::get('/getDoor/{count}/{category?}/{city?}/{price?}/{search?}', [DoorController::class, 'getDoor'])->name('getDoor');
    Route::get('/doorViwe/{id}/{password?}', [ViewControoler::class, 'doorViwe'])->name('doorViwe')->middleware(UserMiddleware::class);
    Route::post('/door/setmessege', [DoorMessegeController::class, 'setMessege'])->name('setMessege');
    Route::get('/door/checkMessege/{door}/{messege}', [DoorMessegeController::class, 'checkMessege'])->name('checkMessege');
    Route::post('/deleteDoor/{id}', [DoorController::class, 'deleteDoor'])->name('deleteDoor');
    Route::get('/pay_city', [UserControllerr::class, 'pay_city'])->name('pay_city')->middleware(UserMiddleware::class);
    Route::get('/user/checkPay', [UserControllerr::class, 'checkPay'])->name('checkPay');
    Route::post('/user/blockMessege', [DoorController::class, 'blockMessege'])->name('blockMessege');


    Route::get('/user/mark/{user}/{door}', [UserControllerr::class, 'mark'])->name('mark');
    Route::get('/user/unmark/{user}/{door}', [UserControllerr::class, 'unmark'])->name('unmark');




    Route::post('/checkHavDoor/{id}', [DoorController::class, 'checkHavDoor'])->name('checkHavDoor');

    // =============== panel door ==============


    // =============== ticket ==============
    // =============== ticket ==============
    Route::post('/user/ticketStor',[TicketController::class,'ticketStor'])->name('ticketStor')->middleware(UserMiddleware::class);
    Route::post('/user/ticketStorAdmin',[TicketController::class,'ticketStorAdmin'])->name('ticketStorAdmin')->middleware(dashbordMiddleware::class);
    // =============== ticket ==============
    // =============== ticket ==============

});

// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================
// ===================user======================


// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
Route::prefix('admin')->group(function () {
    Route::get('login', function () {
        return view('admin.index');
    });
    Route::post('loginAdmin', [AdminController::class, 'loginAdmin'])->name('loginAdmin');
    Route::get('logoutAdmin', [AdminController::class, 'logoutAdmin'])->name('logoutAdmin');
});
Route::middleware(dashbordMiddleware::class)->prefix('dashbord')->group(function () {
    Route::get('/', [AdminController::class,"dashbord"])->name('dashbord');
    Route::resource('grop', GropController::class);
    Route::resource('admins', AdminController::class);
    Route::get('/userShow', [UserControllerr::class, 'userShow'])->name('userShow');
    Route::get('/searchUser', [UserControllerr::class, 'searchUser'])->name('searchUser');
    Route::post('/BlockUser/{user}/{doorMessege?}', [UserControllerr::class, 'BlockUser'])->name('BlockUser');
    Route::post('/unBlockUser/{user}', [UserControllerr::class, 'unBlockUser'])->name('unBlockUser');

    //   ==========info===========
    Route::get('infoSite', [InfowebsiteController::class, 'index'])->name('infoSite');
    Route::post('infowebsite/infoUpfate', [InfowebsiteController::class, 'infoUpfate'])->name('infoUpfate');
    //   ==========info===========e


    //   ==========reject words===========
    Route::get('/rejectWord', [rejectWordController::class, 'rejectWord'])->name('rejectWord');
    Route::post('/addRejectWord', [rejectWordController::class, 'addRejectWord'])->name('addRejectWord');
    Route::delete('/removRejectWord', [rejectWordController::class, 'removRejectWord'])->name('removRejectWord');
    //   ==========reject words===========

    //   ==========door===========
    Route::get('/door', [DoorController::class, 'index'])->name('door');
    Route::get('/setDoor/{id}/{user_id}', [DoorController::class, 'setDoor'])->name('setDoor');
    Route::get('/rejecDoorViwe/{id}/{user_id}', [DoorController::class, 'rejecDoorViwe'])->name('rejecDoorViwe');
    Route::post('/rejecDoor/{id}/{user_id}', [DoorController::class, 'rejecDoor'])->name('rejecDoor');
    Route::get('/doorList', [DoorController::class, 'doorList'])->name('doorList');
    Route::get('/doorShow/{id}', [DoorController::class, 'doorShow'])->name('doorShow');
    Route::post('/pinDoor/{id}/{val}', [DoorController::class, 'pinDoor'])->name('pinDoor');
    Route::post('/deleteMesesege/{id}', [DoorController::class, 'deleteMesesege'])->name('deleteMesesege');
    //   ==========door===========


//    =============== ticket ============
//    =============== ticket ============
    Route::get('ticketList',[TicketController::class,'ticketList'])->name('ticketList');
    Route::get('ticketShow/{id}',[TicketController::class,'ticketShow'])->name('ticketShow');
    Route::post('sendUserSmsTicket',[TicketController::class,'sendUserSmsTicket'])->name('sendUserSmsTicket');
//    =============== ticket ============
//    =============== ticket ============
});
Route::put('/resetDoor/{id}', [DoorController::class, 'resetDoor'])->name('resetDoor');
Route::fallback(function () {
    return view('ibaladam.404');
});
Route::get('error', function () {
    return 'salam';
});

// ===================admin======================~
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================
// ===================admin======================

