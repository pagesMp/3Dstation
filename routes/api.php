<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Handler\Proxy;
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

Route::get('/',function(){
    return "Welcome to my webSide";
});

//Register
Route::post('/register', [UserController::class, 'register']);

//Login
Route::post('/login', [UserController::class, 'login']);

Route::group(
    ['middleware' => 'jwt.auth'],
    function(){           
        Route::get('/logout', [UserController::class, 'logout']);
        Route::post('/profile/update/{id}', [ProfileController::class, 'update']);
    }
);

//LLAMADAS PUBLICAS
Route::group(
    [],
    function(){           
        Route::get('/public/projects/get/{num}', [ProjectController::class, 'getByNum']);
        Route::get('/public/users/get/{num}', [UserController::class, 'getByNum']); 
        Route::get('/public/project/{projectId}/likes/{num}', [ProjectController::class, 'getbylikes']);
        Route::get('/public/profile/{id}', [ProfileController::class, 'profile']);
        Route::get('/public/user/{id}/projects/get/all', [ProjectController::class, 'getAll']); 
        Route::get('/public/project/{projectId}/add/view', [ProjectController::class, 'addView']); 
        Route::get('/public/project/get/{projectId}', [ProjectController::class, 'get']);
        Route::get('/public/projects/search/{title}',[ProjectController::class, 'getByName']);           
    }
);

//CRUD PROJECTS
Route::group(
    ['middleware' => 'jwt.auth'],
    function(){           
        Route::post('/project/create', [ProjectController::class, 'create']);
        Route::post('/project/update/{projectId}', [ProjectController::class, 'update']);
        Route::delete('/project/delete/{projectId}',[ProjectController::class, 'delete']);     
    }
);

//CRUD JOBS
Route::group(
    ['middleware' => 'jwt.auth'],
    function(){           
        Route::post('/job/create', [JobController::class, 'create']);
        Route::get('/job/get/all/{id}', [JobController::class, 'getAll']);
        Route::get('/jobs/get/all', [JobController::class, 'getAllJobs']); 
        Route::get('/job/get/{jobId}', [JobController::class, 'get']);
        Route::put('/job/update/{jobId}', [JobController::class, 'update']);
        Route::delete('/job/delete/{jobId}',[JobController::class, 'delete']);     
    }
);

//CRUD MESSAGE
Route::group(
    ['middleware' => 'jwt.auth'],
    function(){  
        Route::post('/message/create/{id}', [MessageController::class, 'create']);
        Route::get('/message/get/all/{id}', [MessageController::class, 'getAll']);              
    }
);

//CRUD LIKES
Route::group(
    ['middleware' => 'jwt.auth'],
    function(){  
        Route::post('/project/{projectId}/likes/add', [ProjectController::class, 'like']);
        // Route::get('/project/likes/get/{likeId}', [ProjectController::class, 'getLike']); 
        Route::get('/project/{projectId}/likes/get/all', [ProjectController::class, 'getLikes']);
        Route::delete('/project/{projectId}/likes/delete', [ProjectController::class, 'deleteLike']);              
    }
);

//CRUD FOLLOWS
Route::group(
    ['middleware' => 'jwt.auth'],
    function(){  
        Route::post('/profile/{userId}/follow/add', [UserController::class, 'follow']);
        Route::get('/profile/{userId}/follow/get/all', [UserController::class, 'getFollows']);
        Route::delete('/profile/{userId}/follow/delete', [UserController::class, 'deleteFollow']);                
    }
);