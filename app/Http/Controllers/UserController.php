<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Blog;
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
    /**
     * displays profile page
     */
    public function userProfile()
    {
        $user_id = Auth::user();

        $user= User::with('profile')->find($user_id['id']);

        return view('/site/profile',['user'=>$user]);
    }


    /**
     * displays all articles of current user
     */
    public function myArticles()
    {
        $user= Auth::user();

        $blog=Blog::where('user_id','=',$user['id'])->orderBy('created_at','desc')->get();

        return view('/site/my-articles',['blogs'=>$blog]);
    }

    /**
     * in user profile after click on Profile Edit button, modal window displays. after it, works similar to article edit\create
     */
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
        return view('/site/edit-profile',['user' => $user]);
    }


    /**
     * deletes profile from DB
     */
    public function deleteProfile()
    {
        $user_id = Auth::user();

        $user= User::find($user_id['id']);
        $user->delete();

        flash('Your profile was deleted successfully!', 'success');
        return redirect('/');
    }

    public function subscribe()
    {
        $user_id = Auth::user();


        return view('site.profile');
    }

}
