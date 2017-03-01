<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Comments;
use App\Models\User;
use App\Models\UsersProfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash;
use Illuminate\Http\Request;
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

		$avatar= $user->profile->avatar ? $user->profile->avatar : 'no-image.png';

        return view('/site/profile',['user'=>$user, 'avatar'=>$avatar]);
    }


    /**
     * displays all articles of current user
     */
    public function myArticles()
    {
        $user= Auth::user();

        $blog=Articles::where('user_id','=',$user['id'])->orderBy('created_at','desc')->get();

        return view('/site/my-articles',['blogs'=>$blog]);
    }

    /**
     * in user profile after click on Profile Edit button, modal window displays. after it, works similar to article edit\create
     */
    public function editProfile(Request $request)
    {
		$avatar='';

		Auth::user()->profile()->update([
			'firstname'=>$request->firstname,
			'lastname'=>$request->lastname,
			'updated_at'=>Carbon::now('Europe/Kiev')
		]);

		if ($request->hasFile('avatar')){

			$avatar=$request->avatar[0]->store('public/images/avatars');

			Auth::user()->profile()->update([
				'avatar'=>$avatar
			]);
		}
		return [$request->firstname, $request->lastname, $avatar];
    }

    /**
     * deletes profile from DB
     */
    public function deleteProfile(Request $request)
    {
        $logged_user = Auth::user();

        if ($request->input('id') && $logged_user->hasRole('admin')) { //for security reasons

            $user_id=intval($request->input('id'));
            $msg='This';
            $redirectTo=url()->previous();
        } else {

            $user_id=$logged_user['id'];
            $msg='Your';
            $redirectTo='/';
        }

        $user= User::find($user_id);
        $user->delete();

        flash("$msg profile was deleted successfully!", 'success');
        return redirect($redirectTo);
    }


    public function adminUsers()
    {
        $users=User::with('profile')->orderBy('created_at','desc')->paginate(20);

        return view('/admin/users',['users'=>$users]);

    }

    public function adminArticles()
    {
        $articles=Articles::orderBy('created_at','desc')->paginate(10);

        return view('/admin/articles',['articles'=>$articles]);

    }

    public function adminComments()
    {
        $comments=Comments::orderBy('created_at','desc')->paginate(20);

        return view('/admin/comments',['comments'=>$comments]);

    }

    public function deleteComment($id)
    {
        $logged_user = Auth::user();

        $comment= Comments::find(intval($id));

        if ($logged_user->hasRole('admin')) { //for security reasons
            $msg='This';
        } elseif($logged_user['id'] === intval($comment->author_id)) {
            $msg='Your';
        } else
            abort(403);

        $comment->delete();

        flash("$msg comment was deleted successfully!", 'success');
        return redirect(url()->previous());
    }

}
