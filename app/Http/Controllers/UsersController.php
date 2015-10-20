<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

class UsersController extends Controller
{

	/**
	 * Display a user profile
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
    public function show($id)
    {
    	$user = User::findBySlugOrIdOrFail($id);
        return view('users.show')->with('user', $user);
    }

    /**
     * Display a user's submitted tips
     * @return [type] [description]
     */
    public function tips($username)
    {
    	$user = User::findBySlug($username);
        $tips = $user->tips()->withUnapproved()->orderBy('created_at', 'desc')->paginate();
        return view('users.tips')
        	->withUser($user)
        	->withTips($tips);
    }

    /**
     * Display a user's starred tips
     * @return [type] [description]
     */
    public function stars($username)
    {
    	$user = User::findBySlug($username);
    	$tips = $user->stars()->withUnapproved()->orderBy('created_at', 'desc')->paginate();
        return view('users.stars')
        	->withUser($user)
        	->withTips($tips);

    }

}
