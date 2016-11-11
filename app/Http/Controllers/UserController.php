<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\User;
use App\Models\UsersProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Laracasts\Flash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function userProfile()
    {
        $user_id = Auth::user();

        $user= User::with('profile')->find($user_id['id']);

        return view('profile',['user'=>$user]);
    }

    public function editProfile()
    {
        $user_id = Auth::user();

        $user= User::find($user_id);


        if (!empty($_POST))
        {
            $user_id = Auth::user();

            $file = array('image' => Input::file('image'));
            $rules = array('image' => 'mimes:jpeg,bmp,png'); //mimes:jpeg,bmp,png and for max size max:10000

            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                return Redirect::to('/profile')->withInput()->withErrors($validator);
            }
            else
            {
                if (Input::file('image'))
                {
                    $destinationPath = 'images/avatars'; // upload path
                    $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                    $fileName = str_random(30).'.'.$extension; // renaming image
                    Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                    $array_to_update = ['firstname'=>$_POST['firstname'], 'lastname'=>$_POST['lastname'], 'avatar'=>$fileName];
                }
                else
                    $array_to_update = ['firstname'=>$_POST['firstname'], 'lastname'=>$_POST['lastname']];


                $profile=UsersProfile::where(['user_id'=> $user_id['id']])->get();

                if (sizeof($profile)===0)
                {
                    $userProfile= new UsersProfile();
                    $userProfile->user_id=$user_id['id'];
                    $userProfile->firstname=$_POST['firstname'];
                    $userProfile->lastname=$_POST['lastname'];
                    if(isset($fileName))
                    {
                        $userProfile->avatar=$fileName;
                    }
                    $userProfile->save();
                }
                else
                {
                    UsersProfile::where(['user_id'=> $user_id['id']])
                        ->update($array_to_update);
                }

                flash('Your profile was edited successfully!', 'success');
                return redirect('/profile');
            }
        }
        return view('edit-profile',['user' => $user]);
    }

    public function deleteProfile()
    {
        $user_id = Auth::user();

        $user= User::find($user_id['id']);
        $user->delete();

        return redirect('/');
    }
}
