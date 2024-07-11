<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersOFAll;
use Hash;
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
            // Log the user in
            session()->put('UAuth',$user);

            // Redirect to the intended page
            return redirect()->intended('dashboard')->with('success', 'Logged in successfully!');
        } else {
            // Authentication failed
            return back()->withErrors(['email' => 'تأكد من كتابة البريد الاكتروني او كلمة السر بشكل صحيح']);
        }
        
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
