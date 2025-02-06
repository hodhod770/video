<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\EndUser;
use App\Models\Channel;
use App\Models\Videws;
Route::get('/', function () {
    $d=User::get();
    if(count($d)==0)
    {
        $d=new User();
        $d->name="Admin";
        $d->email="admin@gmail.com";
        $d->password=Hash::make("admin");
        $d->save();
    }
    //  3 Channel
    $channels3=Channel::inRandomOrder()->take(5)->get();
    $Videws20=Videws::inRandomOrder()->take(22)->get();
    
    return view('welcome',['channels3'=>$channels3,'Videws20'=>$Videws20]);
})->name('homepage');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/Dept', [App\Http\Controllers\HomeController::class, 'Dept'])->name('Dept');
Route::get('/out', [App\Http\Controllers\HomeController::class, 'out'])->name('out');
Route::get('/userlogin', [UserAuth::class, 'ShowAuth'])->name('userlogin');
Route::Post('/CreateU', [UserAuth::class, 'CreateU'])->name('CreateU');
Route::Post('/userlogin', [UserAuth::class, 'Logins'])->name('userlogin');

Route::middleware(['authUser'])->group(function () {
        Route::get('/dashboard', [UserAuth::class, 'ShowAuth'])->name('dashboard');
        Route::get('/showChannal/{id}', [UserAuth::class, 'showChannal'])->name('showChannal');

   
});

Route::get('/Openv/{id}', [EndUser::class, 'Openv'])->name('Openv');
Route::get('/Openc/{id}', [EndUser::class, 'Openc'])->name('Openc');
Route::get('/video/{filename}', [EndUser::class, 'VideoRun'])->name('video.show');
Route::get('/search', [EndUser::class, 'Search'])->name('search');
Route::get('/Listchannel', [EndUser::class, 'Listchannel'])->name('Listchannel');
Route::get('/SendEmail', [EndUser::class, 'SendEmail'])->name('SendEmail');
Route::get('/PasswordForget', [UserAuth::class, 'PasswordForget'])->name('PasswordForget');
Route::post('/sendemailforgetpassword', [UserAuth::class, 'sendemailforgetpassword'])->name('sendemailforgetpassword');
