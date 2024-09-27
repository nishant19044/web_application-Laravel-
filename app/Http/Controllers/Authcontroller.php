<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\support\Facades\Auth;


class Authcontroller extends Controller
{
    //register
    public function register(Request $request){
             //echo "<h1>Register Method </h1>";
        if($request->isMethod("post")){
                 $request-> validate([
                  "name"  =>"required|string",
                  "email" =>"required|email|unique:users",
                  "phone" =>"required",
                  "password"=>"required" ,      

                 
                ]);
            // form submitted
           User::create([
                "name"=> $request->name,
                "email"=> $request->email,
                "password"=>bcrypt( $request->password),
                "phone=> $request->phone",

           ]);

            //auto login to dashboard
            if(Auth::attempt([
                "email"=> $request->email ,
                "password" =>$request->password,
            ])){

               return to_route('dashboard');

            }else{

                return to_route("register");
            }
         }


          return view("auth.register");
            
    }


   //login
   public function login(Request $request){
   // echo "<h1>Login Method </h1>";

      if($request->isMethod("post")){

          $request->validate([
             
            "email"=> "required",
            "password"=> "required",

          ]);
          if(Auth::attempt([
            "email"=> $request->email ,
                "password" =>$request->password,
          ])){

            return  to_route("dashboard");
          }else{

             return to_route("login")->with("error","invaild login details");

          }

      }

            return view("auth.login");
}
   


  //Dashborad
  public function dashboard(){
    //echo "<h1>Dashboard Method </h1>";
    return view("auth.dashboard");

}
  


//profile
public function profile(){
   // echo "<h1>Profile Method </h1>";

  if($request->isMethod("post")){

    $request->validate([
             
        "name"=> "required|string",
        "phone"=> "required",

      ]);

        $id =auth()->user()->id;               //login user in id
        $user=User ::findOrFail($id);

       
       $user->name = $request->name;
       $user->phone = $request->phone;
       $user->save();

       return  to_route("profile")->with("success","successfully update the profile");
  }


   return view("auth.profile");

}

//logout
public function logout(){
    echo "<h1>Logout Method </h1>";
}


}
