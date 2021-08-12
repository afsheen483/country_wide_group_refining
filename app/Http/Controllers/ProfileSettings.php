<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;

class ProfileSettings extends Controller
{
    public function profile()
    {
       try {
           $user_id = Auth::user()->id;
           $profile = User::where('id','=',$user_id)->get();
           return view('ProfileSettings.profile',compact("profile"));
       } catch (\Throwable $th) {
           //throw $th;
           dd($th);
       }
    }
    public function ChangePassword(Request $request)
    {
        try {
            $hashedPassword = Auth::user()->password;
            // dd($hashedPassword);
            if (\Hash::check($request->old_password , $hashedPassword )) {
              if (!\Hash::check($request->new_password , $hashedPassword)){
                   $users =User::find(Auth::user()->id);
                   $user_id = Auth::user()->id;
                   $users_password = $request->new_password;
                  User::where('id','=',$user_id)->update([
                      'password' => Hash::make($users_password),
                  ]);
                
                   return redirect()->back()->with('message','password updated successfully');
                 }
      
                 else{
                       return redirect()->back()->with('message','new password can not be the old password!');
                     }
      
                }
      
               else{
                   
                    return redirect()->back()->with('message','old password doesnt matched ');
                  }
      
            
      
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
}
