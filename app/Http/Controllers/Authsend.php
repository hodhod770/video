<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AuthEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Hash;

class Authsend extends Controller
{
    public function SendEmail($name,$email)
    {
        $verificationCode = rand(100000, 999999);
        $details = [
            'name' => $name,
            'code' => $verificationCode
        ];
        
        // dd($email);
        Mail::to($email)->send(new AuthEmail($details));

        return Hash::make($verificationCode);
    }
}
