<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\AuthController;
use \App\Http\Controllers\API\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('/user')->group(function(){
    Route::post('/register', App\User\Actions\CreateUserAction::class)->name('auth.register');
    Route::post('test',[UserController::class,'test']);

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login',[AuthController::class,'login'])->name('user.login');
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me',[AuthController::class,'me']);
});

Route::prefix('/attendence')->group(function(){
    Route::get('/ranking',App\Attendence\Actions\ShowRankingAction::class)->name('att.rank'); //11
    Route::middleware(['auth:api'])->group(function () {
        Route::get('/my/attendence',App\Attendence\Actions\ShowMyAttendenceRateAction::class)->name('my.Attendence'); //7
        Route::post('/',App\Attendence\Actions\UpdateAttendenceAction::class)->name('attendence.add');//9
        Route::post('/reason',App\Attendence\Actions\UpdateReasonAction::class)->name('add.reason'); //10
        Route::get('/today/my/attendence',App\Attendence\Actions\ShowMyTodayAttendenceAction::class)->name('Today.attendence');//8
        Route::get('/group/attendence',App\User\Actions\ShowGroupAttendenceAction::class)->name('group.attendence');
        Route::middleware(['professor'])->group(function () {
            Route::get('/all/info/{page}',App\Attendence\Actions\ShowAllAttendencesAction::class)->name('all.att'); // 모든 지각 확인
            Route::get('/today/{page}',App\Attendence\Actions\ShowTodayAttendencesAction::class)->name('Today.attendence');//4    
            Route::put('/reason/acception',App\Attendence\Actions\UpdateCheckReasonAction::class)->name('update.Attendence'); //6
        });
    });
});

Route::prefix('/penalty')->group(function(){
    Route::middleware(['auth:api'])->group(function () {
        Route::get('/left',App\Penalty\Actions\ShowLeftPenaltyAction::class)->name('my.penalty');
        Route::get('/all',App\Penalty\Actions\ShowAllPenaltyAction::class)->name('all.penalty');  
        Route::post('/image',App\Penalty\Actions\UpdatePenaltyImgAction::class)->name('upload.penalty');
        Route::get('/image',App\Penalty\Actions\ShowPenaltyImgAction::class)->name('upload.penalty');
        Route::middleware(['professor'])->group(function(){
            Route::get('/all/left',App\Penalty\Actions\ShowLeftAllPenaltyAction::class)->name('upload.penalty');
            Route::get('/clear/image',App\Penalty\Actions\ShowPenaltyClearImgAction::class)->name('clear.image');
        });
    });
});