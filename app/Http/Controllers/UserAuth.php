<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersOFAll;
use Hash;
use App\Http\Controllers\Authsend;

class UserAuth extends Controller
{
    public function ShowAuth()
    {
        if(session('UAuth'))
        {
            return view('UserDash.dashbord');
        }
        else
        {
            return view('auth.userlogin');
        }
        
    }

    public function CreateU(Request $request )
    {
       $em= UsersOFAll::Where('email',$request->email)->get();
       if(count($em)>0)
       {
        session()->put('CreateUserErorr','هذا الايميل موجود ب الفعل');
        return back();
       }
    
        $d=new UsersOFAll();
        $d->name=$request->name;
        $d->email=$request->email;
        $d->password=Hash::make($request->password);
        $d->save();
        return back();

    }
    public function Logins(Request $request)
    {
       
        $user = UsersOFAll::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->IsEmailAuth==1) {
                // Log the user in
                session()->put('UAuth',$user);
                return redirect()->intended('dashboard')->with('success', 'Logged in successfully!');
            }
            else {
                session()->put('UAuth_not_auth',$user);
                $au=new Authsend();
                $code=$au->SendEmail($user->name,$user->email);
                session()->put('usercode',$code);
                return view('auth.codeauth');
              
            }
            
        } else {
            // Authentication failed
            return back()->withErrors(['email' => 'تأكد من كتابة البريد الاكتروني او كلمة السر بشكل صحيح']);
        }
        
    }

    public function PasswordForget()
    {
        return view('auth.forgetpass');
    }

    public function sendemailforgetpassword($email)
    {
        $u=UsersOFAll::where()->first();
        return view('auth.codeauth');
    }
    public function showChannal($id)
    {
        if(session('UAuth'))
        {
            return view('UserDash.ChannalManage',['id'=>$id]);
        }
        else
        {
            return view('auth.userlogin');
        }
        
    }


    

   
}
