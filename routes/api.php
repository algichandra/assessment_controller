<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//group route with prefix "admin"
Route::prefix('admin')->group(function () {

    //route login
    Route::post('/login', [App\Http\Controllers\Api\Admin\LoginController::class, 'index']);

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth:api'], function () {

        //data user
        Route::get('/user', [App\Http\Controllers\Api\Admin\LoginController::class, 'getUser']);

        //refresh token JWT
        Route::get('/refresh', [App\Http\Controllers\Api\Admin\LoginController::class, 'refreshToken']);

        //logout
        Route::post('/logout', [App\Http\Controllers\Api\Admin\LoginController::class, 'logout']);

        //Tags
        Route::apiResource('/tags', App\Http\Controllers\Api\Admin\TagController::class);

        //Category
        Route::apiResource('/categories', App\Http\Controllers\Api\Admin\CategoryController::class);

        //Poss
        Route::apiResource('/posts', App\Http\Controllers\Api\Admin\PostController::class);

        //Menus
        Route::apiResource('/menus', App\Http\Controllers\Api\Admin\MenuController::class);

        //Sliders
        Route::apiResource('/sliders', App\Http\Controllers\Api\Admin\SliderController::class);

        //Users
        Route::apiResource('/users', App\Http\Controllers\Api\Admin\UserController::class);

        //dashboard
        Route::get('/dashboard', [App\Http\Controllers\Api\Admin\DashboardController::class, 'index']);
    });
});

//group route with prefix "web"
Route::prefix('web')->group(function () {

    //index tags
    Route::get('/tags', [App\Http\Controllers\Api\Web\TagController::class, 'index']);

    //show tag
    Route::get('/tags/{slug}', [App\Http\Controllers\Api\Web\TagController::class, 'show']);

    //index categories
    Route::get('/categories', [App\Http\Controllers\Api\Web\CategoryController::class, 'index']);

    //show category
    Route::get('/categories/{slug}', [App\Http\Controllers\Api\Web\CategoryController::class, 'show']);

    //categories sidebar
    Route::get('/categorySidebar', [App\Http\Controllers\Api\Web\CategoryController::class, 'categorySidebar']);

    //index posts
    Route::get('/posts', [App\Http\Controllers\Api\Web\PostController::class, 'index']);

    //show posts
    Route::get('/posts/{slug}', [App\Http\Controllers\Api\Web\PostController::class, 'show']);

    //posts homepage
    Route::get('/postHomepage', [App\Http\Controllers\Api\Web\PostController::class, 'postHomepage']);

    //store comment
    Route::post('/posts/storeComment', [App\Http\Controllers\Api\Web\PostController::class, 'storeComment']);

    //store image
    Route::post('/posts/storeImage', [App\Http\Controllers\Api\Web\PostController::class, 'storeImagePost']);

    //index menus
    Route::get('/menus', [App\Http\Controllers\Api\Web\MenuController::class, 'index']);

    //index sliders
    Route::get('/sliders', [App\Http\Controllers\Api\Web\SliderController::class, 'index']);
});

Route::prefix('assessment')->group(function () {

    Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

    Route::get('/user_apk', [App\Http\Controllers\Api\Assessment\Opd\UserApkController::class, 'index']);
    Route::get('/jenis_kegiatan', [App\Http\Controllers\Api\Assessment\Opd\JenisKegiatanController::class, 'index']);
    Route::get('/status', [App\Http\Controllers\Api\Assessment\Assessor\StatusController::class, 'index']);

    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::prefix('admin')->group(function () {

            Route::apiResource('/user', App\Http\Controllers\Api\Assessment\Admin\UserController::class)->middleware('restrictRole:admin');
            Route::apiResource('/opd', App\Http\Controllers\Api\Assessment\Admin\OpdController::class)->middleware('restrictRole:admin');
        });

        Route::prefix('opd')->group(function () {

            Route::apiResource('/developer', App\Http\Controllers\Api\Assessment\Opd\DeveloperController::class)->middleware('restrictRole:opd');

            Route::apiResource('/programer', App\Http\Controllers\Api\Assessment\Opd\ProgramerController::class)->middleware('restrictRole:opd');

            Route::apiResource('/aplikasi', App\Http\Controllers\Api\Assessment\Opd\ApkController::class)->middleware('restrictRole:opd');
            Route::put('/aplikasi/update/{apk}', [App\Http\Controllers\Api\Assessment\Opd\ApkController::class, 'update']);
            Route::delete('/aplikasi/delete/{apk}', [App\Http\Controllers\Api\Assessment\Opd\ApkController::class, 'destroy']);

            Route::apiResource('/assessment', App\Http\Controllers\Api\Assessment\Opd\AssessmentController::class)->middleware('restrictRole:opd');

            Route::apiResource('/hosting_subdomain', App\Http\Controllers\Api\Assessment\Opd\HostingSubDomainController::class,)->middleware('restrictRole:opd');

            Route::apiResource('/dokumen', App\Http\Controllers\Api\Assessment\Opd\DokController::class,)->middleware('restrictRole:opd');

            Route::get('/getAssessmentById/{id}', [App\Http\Controllers\Api\Assessment\Opd\AssessmentController::class, 'getAssessmentById'])->middleware('restrictRole:opd');
            Route::get('/getAssessmentSelesaiById/{id}', [App\Http\Controllers\Api\Assessment\Opd\AssessmentController::class, 'getAssessmentSelesaiById'])->middleware('restrictRole:opd');
        });

        Route::prefix('assessor')->group(function () {

            Route::apiResource('/tata_kelola', App\Http\Controllers\Api\Assessment\Assessor\TataKelolaController::class)->middleware('restrictRole:assessment');

            Route::apiResource('/penilaian_tata_kelola', App\Http\Controllers\Api\Assessment\Assessor\PenilaianTataKelolaController::class)->middleware('restrictRole:assessment');

            Route::apiResource('/penilaian_ui_ux', App\Http\Controllers\Api\Assessment\Assessor\PenilaianUiUxController::class)->middleware('restrictRole:assessment');

            Route::apiResource('/penilaian_otentifikasi', App\Http\Controllers\Api\Assessment\Assessor\PenilaianOtentifikasiController::class)->middleware('restrictRole:assessment');

            Route::apiResource('/manajemen_sesi', App\Http\Controllers\Api\Assessment\Assessor\ManajemenSesiController::class)->middleware('restrictRole:assessment');

            Route::apiResource('/kontrol_akses', App\Http\Controllers\Api\Assessment\Assessor\KontrolAksesController::class)->middleware('restrictRole:assessment');

            Route::get('/getAssessmentOpd', [App\Http\Controllers\Api\Assessment\Opd\AssessmentController::class, 'getAssessmentOpd'])->middleware('restrictRole:assessment');
            Route::get('/getRiwayatAssessmentOpd', [App\Http\Controllers\Api\Assessment\Opd\AssessmentController::class, 'getRiwayatAssessmentOpd'])->middleware('restrictRole:assessment');
            Route::get('/getAssessmentOpdSelesai', [App\Http\Controllers\Api\Assessment\Opd\AssessmentController::class, 'getAssessmentOpdSelesai'])->middleware('restrictRole:assessment');
        });
    });
});
